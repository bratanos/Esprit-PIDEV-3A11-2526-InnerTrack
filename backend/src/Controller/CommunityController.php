<?php

namespace App\Controller;

use App\Entity\CommunityComment;
use App\Entity\CommunityReaction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/community')]
final class CommunityController extends AbstractController
{
    // Recursively collect all replies under a comment (flattened in order)
    private function collectAllReplies(CommunityComment $comment, array &$map): void
    {
        foreach ($comment->getReplies() as $reply) {
            $map[$reply->getId()] = $reply;
            $this->collectAllReplies($reply, $map);
        }
    }

    #[Route(name: 'app_community_index', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if ($request->isMethod('POST') && $request->request->get('quick_post')) {
            $content  = trim($request->request->get('content', ''));
            $title    = trim($request->request->get('title', ''));
            $parentId = $request->request->get('parent_id');
        
            if ($content !== '' && $user) {
                $client = \Symfony\Component\HttpClient\HttpClient::create();
        
                // 1. Translate content FR → EN
                $translatedContent = $content;
                try {
                    $url = sprintf(
                        'https://api.mymemory.translated.net/get?q=%s&langpair=%s',
                        urlencode($content),
                        urlencode('fr|en')
                    );
                    $response = $client->request('GET', $url);
                    $json = $response->toArray();
                    $translatedContent = $json['responseData']['translatedText'] ?? $content;
                } catch (\Exception $e) {}
        
                // 2. Censor translated content
                $censoredContent = $translatedContent;
                try {
                    $response = $client->request('GET',
                        'https://www.purgomalum.com/service/plain?text=' . urlencode($translatedContent)
                    );
                    $censoredContent = $response->getContent();
                } catch (\Exception $e) {}
                if ($censoredContent !== $translatedContent) {
                    $this->addFlash('warning', 'Profanity detected! Your input was censored to: ' . $censoredContent);
                }
        
                // 3. Translate + censor title if provided
                $censoredTitle = null;
                if ($title !== '') {
                    $translatedTitle = $title;
                    try {
                        $url = sprintf(
                            'https://api.mymemory.translated.net/get?q=%s&langpair=%s',
                            urlencode($title),
                            urlencode('fr|en')
                        );
                        $response = $client->request('GET', $url);
                        $json = $response->toArray();
                        $translatedTitle = $json['responseData']['translatedText'] ?? $title;
                    } catch (\Exception $e) {}
        
                    $censoredTitle = $translatedTitle;
                    try {
                        $response = $client->request('GET',
                            'https://www.purgomalum.com/service/plain?text=' . urlencode($translatedTitle)
                        );
                        $censoredTitle = $response->getContent();
                    } catch (\Exception $e) {}
                    if ($censoredTitle !== $translatedTitle) {
                        $this->addFlash('warning', 'Profanity detected in title! It was censored to: ' . $censoredTitle);
                    }
                }
        
                // 4. Save censored values (with ****)
                $post = new CommunityComment();
                $post->setContent($censoredContent);
                $post->setUser($user);
        
                if ($parentId) {
                    $parent = $em->getRepository(CommunityComment::class)->find($parentId);
                    if ($parent) {
                        $post->setParent($parent);
                    }
                } elseif ($censoredTitle) {
                    $post->setTitle($censoredTitle);
                }
        
                $em->persist($post);
                $em->flush();
            }
        
            return $this->redirectToRoute('app_community_index');
        }
        

        // Handle react / unreact
        if ($request->isMethod('POST') && $request->request->get('react')) {
            $commentId = $request->request->get('comment_id');
            $emoji     = $request->request->get('emoji');
            $allowed   = ['👍', '❤️', '😂', '😮', '😢', '😡'];

            if ($user && $commentId && in_array($emoji, $allowed, true)) {
                $comment  = $em->getRepository(CommunityComment::class)->find($commentId);
                $existing = $em->getRepository(CommunityReaction::class)->findOneBy([
                    'user'    => $user,
                    'comment' => $comment,
                ]);

                if ($existing) {
                    if ($existing->getReaction() === $emoji) {
                        // Same emoji clicked again → remove reaction
                        $em->remove($existing);
                    } else {
                        // Different emoji → update
                        $existing->setReaction($emoji);
                    }
                } else {
                    $reaction = new CommunityReaction();
                    $reaction->setUser($user);
                    $reaction->setComment($comment);
                    $reaction->setReaction($emoji);
                    $em->persist($reaction);
                }

                $em->flush();
            }

            return $this->redirectToRoute('app_community_index');
        }

        // Load top-level posts
        $posts = $em->getRepository(CommunityComment::class)
            ->findBy(['parent' => null], ['createdAt' => 'DESC']);

        // Build a replies map: postId => flat list of all nested replies in order
        $repliesMap = [];
        foreach ($posts as $post) {
            $map = [];
            $this->collectAllReplies($post, $map);
            $repliesMap[$post->getId()] = array_values($map);
        }

        return $this->render('pages/community/index.html.twig', [
            'posts'       => $posts,
            'replies_map' => $repliesMap,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_community_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommunityComment $comment, EntityManagerInterface $em): Response
    {
        // Only owner can edit
        if ($this->getUser()?->getId() !== $comment->getUser()->getId()) {
            throw $this->createAccessDeniedException();
        }

        if ($request->isMethod('POST')) {
            $content = trim($request->request->get('content', ''));
            $title   = trim($request->request->get('title', ''));

            if ($content !== '') {
                $client = \Symfony\Component\HttpClient\HttpClient::create();
            
                // 1. Translate content FR → EN
                $translatedContent = $content;
                try {
                    $url = sprintf(
                        'https://api.mymemory.translated.net/get?q=%s&langpair=%s',
                        urlencode($content),
                        urlencode('fr|en')
                    );
                    $response = $client->request('GET', $url);
                    $json = $response->toArray();
                    $translatedContent = $json['responseData']['translatedText'] ?? $content;
                } catch (\Exception $e) {}
            
                // 2. Censor translated content
                $censoredContent = $translatedContent;
                try {
                    $response = $client->request('GET',
                        'https://www.purgomalum.com/service/plain?text=' . urlencode($translatedContent)
                    );
                    $censoredContent = $response->getContent();
                } catch (\Exception $e) {}
                if ($censoredContent !== $translatedContent) {
                    $this->addFlash('warning', 'Profanity detected! Your content was censored to: ' . $censoredContent);
                }
            
                // 3. Translate + censor title if provided
                $censoredTitle = null;
                if ($title !== '') {
                    $translatedTitle = $title;
                    try {
                        $url = sprintf(
                            'https://api.mymemory.translated.net/get?q=%s&langpair=%s',
                            urlencode($title),
                            urlencode('fr|en')
                        );
                        $response = $client->request('GET', $url);
                        $json = $response->toArray();
                        $translatedTitle = $json['responseData']['translatedText'] ?? $title;
                    } catch (\Exception $e) {}
            
                    $censoredTitle = $translatedTitle;
                    try {
                        $response = $client->request('GET',
                            'https://www.purgomalum.com/service/plain?text=' . urlencode($translatedTitle)
                        );
                        $censoredTitle = $response->getContent();
                    } catch (\Exception $e) {}
                    if ($censoredTitle !== $translatedTitle) {
                        $this->addFlash('warning', 'Profanity detected in title! It was censored to: ' . $censoredTitle);
                    }
                }
            
                // 4. Save censored values
                $comment->setContent($censoredContent);
                $comment->setTitle($censoredTitle !== null ? $censoredTitle : null);
                $comment->setModified(true);
                $em->flush();
            }
            

            return $this->redirectToRoute('app_community_index');
        }

        return $this->render('pages/community/edit.html.twig', [
            'comment' => $comment,
        ]);
    }

    #[Route('/{id}', name: 'app_community_delete', methods: ['POST'])]
    public function delete(Request $request, CommunityComment $comment, EntityManagerInterface $em): Response
    {
        if ($this->getUser()?->getId() !== $comment->getUser()->getId()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->getPayload()->getString('_token'))) {
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('app_community_index');
    }

    // ─── Report a community post/comment ─────────────────────────────────────
    #[Route('/{id}/report', name: 'app_community_report', methods: ['POST'])]
    public function report(
        Request $request,
        CommunityComment $comment,
        EntityManagerInterface $em
    ): \Symfony\Component\HttpFoundation\JsonResponse {
        /** @var \App\Entity\User $currentUser */
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $data    = json_decode($request->getContent(), true);
        $reason  = strtoupper(trim($data['reason'] ?? 'OTHER'));
        $allowed = ['SPAM', 'HARASSMENT', 'INAPPROPRIATE', 'OTHER'];
        if (!in_array($reason, $allowed, true)) {
            $reason = 'OTHER';
        }

        // Prevent duplicate pending report from same reporter on same post author
        $existing = $em->getRepository(\App\Entity\Report::class)->findOneBy([
            'reporter' => $currentUser,
            'reported' => $comment->getUser(),
            'context'  => 'COMMUNITY',
            'status'   => 'PENDING',
        ]);
        if ($existing) {
            return $this->json(['error' => 'You already have a pending report against this user.'], 409);
        }

        $report = new \App\Entity\Report();
        $report->setReporter($currentUser)
               ->setReported($comment->getUser())
               ->setReason($reason)
               ->setContext('COMMUNITY')
               ->setDetails(mb_substr($comment->getContent(), 0, 300));

        $em->persist($report);
        $em->flush();

        return $this->json(['success' => true]);
    }
}
