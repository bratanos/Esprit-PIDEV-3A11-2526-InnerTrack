<?php

namespace App\Tests\Functional;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class UserProfileCrudTest
 * 
 * Technical Explanation for the Professor:
 * This is a FUNCTIONAL TEST (also known as an Integration or Web Test).
 * It simulates a real browser interaction with the application.
 * 
 * Flow:
 * 1. Arrange: We prepare a test user in the database.
 * 2. Act: We use the Symfony 'BrowserKit' client to log in, navigate to /profile, 
 *    and submit a POST request with new data.
 * 3. Assert: We verify that the response is a redirect (success) and that 
 *    the database has been updated with the new values.
 * 
 * This demonstrates the full lifecycle: Request -> Controller -> Entity -> Database.
 */
class UserProfileCrudTest extends WebTestCase
{
    /**
     * Test the full "Update" (U in CRUD) for a User Profile.
     */
    public function testUpdateProfile(): void
    {
        $client = static::createClient();
        $container = self::getContainer();
        $userRepository = $container->get(UserRepository::class);
        $entityManager = $container->get('doctrine.orm.entity_manager');

        // 1. Setup a test user
        $testEmail = 'test_crud_' . uniqid() . '@example.com';
        $user = new User();
        $user->setEmail($testEmail);
        $user->setPassword('password123'); // In real tests, use a hashed password if needed
        $user->setFirstName('Original');
        $user->setLastName('Name');
        $user->setRoles(['ROLE_USER']);
        $user->setIsVerified(true);
        
        $entityManager->persist($user);
        $entityManager->flush();

        // 2. Log in as this user
        $client->loginUser($user);

        // 3. Navigate to the profile page
        $crawler = $client->request('GET', '/profile');
        $this->assertResponseIsSuccessful();

        // 4. Submit the update form (CRUD: Update)
        // We simulate the form submission manually via POST
        $client->request('POST', '/profile', [
            'firstName'   => 'UpdatedFirst',
            'lastName'    => 'UpdatedLast',
            'phoneNumber' => '0123456789',
            'bio'         => 'This is my new technical bio for the test.'
        ]);

        // 5. Assert Redirect (Symfony redirects back to profile on success)
        $this->assertResponseRedirects('/profile');
        $client->followRedirect();
        $this->assertSelectorTextContains('.alert-success', 'Profil mis à jour avec succès');

        // 6. Verify Database (Final check of the CRUD operation)
        $updatedUser = $userRepository->findOneBy(['email' => $testEmail]);
        $this->assertEquals('UpdatedFirst', $updatedUser->getFirstName());
        $this->assertEquals('UpdatedLast', $updatedUser->getLastName());
        $this->assertEquals('0123456789', $updatedUser->getPhoneNumber());
        
        // Cleanup: Remove test user
        $entityManager->remove($updatedUser);
        $entityManager->flush();
    }
}
