package com.innertrack.service;

import com.innertrack.dao.ArticleDao;
import com.innertrack.model.Article;
import com.innertrack.util.KeywordExtractor;

import java.util.*;
import java.util.stream.Collectors;

public class SimilarityService {
    private final ArticleDao articleDao;

    public SimilarityService() {
        this.articleDao = new ArticleDao();
    }

    public List<Article> findSimilarArticles(Article currentArticle, int limit) {
        List<Article> allArticles = articleDao.findAll();
        if (allArticles.size() <= 1)
            return new ArrayList<>();

        // Simple TF-IDF like similarity based on common tokens
        Set<String> currentKeywords = KeywordExtractor.extractKeywords(currentArticle.getContenu());

        return allArticles.stream()
                .filter(a -> a.getId() != currentArticle.getId())
                .map(a -> {
                    Set<String> otherKeywords = KeywordExtractor.extractKeywords(a.getContenu());
                    long intersectionSize = otherKeywords.stream()
                            .filter(currentKeywords::contains)
                            .count();
                    double score = (double) intersectionSize / Math.max(1, currentKeywords.size());
                    return new ArticleScore(a, score);
                })
                .filter(as -> as.score > 0)
                .sorted(Comparator.comparingDouble((ArticleScore as) -> as.score).reversed())
                .limit(limit)
                .map(as -> as.article)
                .collect(Collectors.toList());
    }

    private static class ArticleScore {
        Article article;
        double score;

        ArticleScore(Article a, double s) {
            this.article = a;
            this.score = s;
        }
    }
}
