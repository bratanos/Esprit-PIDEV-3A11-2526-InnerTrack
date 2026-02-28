package com.innertrack.util;

import com.innertrack.model.Article;
import org.apache.lucene.analysis.standard.StandardAnalyzer;
import org.apache.lucene.document.*;
import org.apache.lucene.index.*;
import org.apache.lucene.queryparser.classic.MultiFieldQueryParser;
import org.apache.lucene.search.*;
import org.apache.lucene.store.Directory;
import org.apache.lucene.store.FSDirectory;

import java.io.IOException;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.List;

public class ArticleIndexer {
    private final Directory directory;
    private final StandardAnalyzer analyzer;
    private static final String INDEX_DIR = "lucene_index";

    public ArticleIndexer() throws IOException {
        this.directory = FSDirectory.open(Paths.get(INDEX_DIR));
        this.analyzer = new StandardAnalyzer();
    }

    public void indexArticle(Article article) throws IOException {
        IndexWriterConfig config = new IndexWriterConfig(analyzer);
        try (IndexWriter writer = new IndexWriter(directory, config)) {
            Document doc = new Document();
            doc.add(new StringField("id", String.valueOf(article.getId()), Field.Store.YES));
            doc.add(new TextField("titre", article.getTitre(), Field.Store.YES));
            doc.add(new TextField("contenu", article.getContenu(), Field.Store.YES));
            if (article.getCategorieNom() != null) {
                doc.add(new TextField("categorie", article.getCategorieNom(), Field.Store.YES));
            }
            writer.updateDocument(new Term("id", String.valueOf(article.getId())), doc);
        }
    }

    public void updateArticle(Article article) throws IOException {
        indexArticle(article);
    }

    public void clearIndex() throws IOException {
        IndexWriterConfig config = new IndexWriterConfig(analyzer);
        try (IndexWriter writer = new IndexWriter(directory, config)) {
            writer.deleteAll();
            writer.commit();
        }
    }

    public void deleteArticle(int articleId) throws IOException {
        IndexWriterConfig config = new IndexWriterConfig(analyzer);
        try (IndexWriter writer = new IndexWriter(directory, config)) {
            writer.deleteDocuments(new Term("id", String.valueOf(articleId)));
        }
    }

    public List<Integer> search(String queryStr, int maxResults) throws Exception {
        try (IndexReader reader = DirectoryReader.open(directory)) {
            if (reader == null)
                return new ArrayList<>();
            IndexSearcher searcher = new IndexSearcher(reader);
            MultiFieldQueryParser parser = new MultiFieldQueryParser(
                    new String[] { "titre", "contenu", "categorie" },
                    analyzer);
            Query query = parser.parse(queryStr);
            TopDocs topDocs = searcher.search(query, maxResults);
            List<Integer> ids = new ArrayList<>();
            for (ScoreDoc scoreDoc : topDocs.scoreDocs) {
                Document doc = searcher.doc(scoreDoc.doc);
                ids.add(Integer.parseInt(doc.get("id")));
            }
            return ids;
        } catch (IOException e) {
            return new ArrayList<>();
        }
    }
}
