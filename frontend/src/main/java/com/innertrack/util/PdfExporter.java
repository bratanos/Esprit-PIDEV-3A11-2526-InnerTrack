package com.innertrack.util;

import com.innertrack.model.EntreeJournal;
import com.innertrack.model.Habitude;
import com.itextpdf.text.*;
import com.itextpdf.text.pdf.*;

import java.io.FileOutputStream;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.List;

public class PdfExporter {

    private static final BaseColor VIOLET_DARK = new BaseColor(88, 56, 163);
    private static final BaseColor VIOLET_LIGHT = new BaseColor(118, 91, 194);
    private static final BaseColor BG_LIGHT = new BaseColor(245, 247, 250);
    private static final BaseColor BORDER_GREY = new BaseColor(226, 232, 240);
    private static final BaseColor TEXT_DARK = new BaseColor(45, 55, 72);
    private static final BaseColor TEXT_GREY = new BaseColor(113, 128, 150);
    private static final BaseColor WHITE = BaseColor.WHITE;

    private static final BaseColor COLOR_RED = new BaseColor(255, 68, 68);
    private static final BaseColor COLOR_YELLOW = new BaseColor(246, 173, 85);
    private static final BaseColor COLOR_GREEN = new BaseColor(72, 187, 120);
    private static final BaseColor COLOR_BLUE = new BaseColor(66, 153, 225);
    private static final BaseColor COLOR_PURPLE = new BaseColor(183, 148, 244);
    private static final BaseColor COLOR_GREY = new BaseColor(160, 174, 192);
    private static final BaseColor COLOR_GOLD = new BaseColor(246, 166, 35);
    private static final BaseColor COLOR_DARK_BLUE = new BaseColor(43, 108, 176);

    private static Font fontTitle() {
        return new Font(Font.FontFamily.HELVETICA, 26, Font.BOLD, WHITE);
    }

    private static Font fontSubtitle() {
        return new Font(Font.FontFamily.HELVETICA, 11, Font.NORMAL, new BaseColor(200, 190, 240));
    }

    private static Font fontBrand() {
        return new Font(Font.FontFamily.HELVETICA, 13, Font.BOLD, new BaseColor(200, 190, 240));
    }

    private static Font fontSectionTitle() {
        return new Font(Font.FontFamily.HELVETICA, 13, Font.BOLD, VIOLET_DARK);
    }

    private static Font fontColHeader() {
        return new Font(Font.FontFamily.HELVETICA, 10, Font.BOLD, WHITE);
    }

    private static Font fontCell() {
        return new Font(Font.FontFamily.HELVETICA, 9, Font.NORMAL, TEXT_DARK);
    }

    private static Font fontCellBold() {
        return new Font(Font.FontFamily.HELVETICA, 9, Font.BOLD, TEXT_DARK);
    }

    private static Font fontBadge(BaseColor c) {
        return new Font(Font.FontFamily.HELVETICA, 9, Font.BOLD, c);
    }

    private static Font fontFooter() {
        return new Font(Font.FontFamily.HELVETICA, 8, Font.ITALIC, TEXT_GREY);
    }

    private static Font fontStats() {
        return new Font(Font.FontFamily.HELVETICA, 18, Font.BOLD, VIOLET_DARK);
    }

    private static Font fontStatsLabel() {
        return new Font(Font.FontFamily.HELVETICA, 8, Font.NORMAL, TEXT_GREY);
    }

    private static BaseColor couleurStress(int v) {
        return v >= 7 ? COLOR_RED : v >= 4 ? COLOR_YELLOW : new BaseColor(99, 179, 237);
    }

    private static String labelStress(int v) {
        return v >= 7 ? "Alarme" : v >= 4 ? "Tension" : "Zen";
    }

    private static BaseColor couleurEnergie(int v) {
        return v >= 7 ? COLOR_GREEN : v >= 4 ? COLOR_YELLOW : COLOR_RED;
    }

    private static String labelEnergie(int v) {
        return v >= 7 ? "Vitalite" : v >= 4 ? "Moyenne" : "Vide";
    }

    private static BaseColor couleurSommeil(int v) {
        return v >= 7 ? COLOR_PURPLE : v >= 4 ? COLOR_BLUE : COLOR_GREY;
    }

    private static String labelSommeil(int v) {
        return v >= 7 ? "Recupere" : v >= 4 ? "Repose" : "Fatigue";
    }

    private static BaseColor couleurHumeur(int v) {
        return v >= 7 ? COLOR_GOLD : v >= 4 ? COLOR_GREEN : COLOR_DARK_BLUE;
    }

    private static String labelHumeur(int v) {
        return v >= 7 ? "Joie" : v >= 4 ? "Stable" : "Tristesse";
    }

    private static PdfPCell badgeCell(int val, BaseColor couleur, String label) {
        PdfPCell cell = new PdfPCell(new Phrase(val + " - " + label, fontBadge(couleur)));
        cell.setBackgroundColor(new BaseColor(
                Math.min(255, couleur.getRed() + 60),
                Math.min(255, couleur.getGreen() + 60),
                Math.min(255, couleur.getBlue() + 60)));
        cell.setBorderColor(couleur);
        cell.setBorderWidth(1f);
        cell.setPadding(5f);
        cell.setHorizontalAlignment(Element.ALIGN_CENTER);
        cell.setVerticalAlignment(Element.ALIGN_MIDDLE);
        return cell;
    }

    private static PdfPCell textCell(String text, int align, boolean bold) {
        PdfPCell cell = new PdfPCell(new Phrase(text, bold ? fontCellBold() : fontCell()));
        cell.setBackgroundColor(WHITE);
        cell.setBorderColor(BORDER_GREY);
        cell.setBorderWidth(0.5f);
        cell.setPadding(6f);
        cell.setHorizontalAlignment(align);
        cell.setVerticalAlignment(Element.ALIGN_MIDDLE);
        return cell;
    }

    private static PdfPCell headerCell(String text) {
        PdfPCell cell = new PdfPCell(new Phrase(text, fontColHeader()));
        cell.setBackgroundColor(VIOLET_DARK);
        cell.setBorderWidth(0);
        cell.setPadding(8f);
        cell.setHorizontalAlignment(Element.ALIGN_CENTER);
        cell.setVerticalAlignment(Element.ALIGN_MIDDLE);
        return cell;
    }

    private static void ajouterHeader(Document doc, String titre, String sousTitre,
            int nbItems, String dateExport) throws DocumentException {
        PdfPTable banner = new PdfPTable(1);
        banner.setWidthPercentage(100);
        PdfPCell bannerCell = new PdfPCell();
        bannerCell.setBackgroundColor(VIOLET_DARK);
        bannerCell.setBorderWidth(0);
        bannerCell.setPadding(25f);
        Paragraph brand = new Paragraph("InnerTrack", fontBrand());
        brand.setSpacingAfter(4f);
        Paragraph titreP = new Paragraph(titre, fontTitle());
        titreP.setSpacingAfter(6f);
        Paragraph sousP = new Paragraph(sousTitre, fontSubtitle());
        bannerCell.addElement(brand);
        bannerCell.addElement(titreP);
        bannerCell.addElement(sousP);
        banner.addCell(bannerCell);
        doc.add(banner);
        doc.add(Chunk.NEWLINE);

        PdfPTable stats = new PdfPTable(3);
        stats.setWidthPercentage(100);
        stats.setWidths(new float[] { 1f, 1f, 1f });

        PdfPCell s1 = new PdfPCell();
        s1.setBackgroundColor(BG_LIGHT);
        s1.setBorderColor(BORDER_GREY);
        s1.setBorderWidth(1f);
        s1.setPadding(12f);
        Paragraph nb = new Paragraph(String.valueOf(nbItems), fontStats());
        nb.setAlignment(Element.ALIGN_CENTER);
        Paragraph nbLabel = new Paragraph("Entrees", fontStatsLabel());
        nbLabel.setAlignment(Element.ALIGN_CENTER);
        s1.addElement(nb);
        s1.addElement(nbLabel);
        stats.addCell(s1);

        PdfPCell s2 = new PdfPCell();
        s2.setBackgroundColor(BG_LIGHT);
        s2.setBorderColor(BORDER_GREY);
        s2.setBorderWidth(1f);
        s2.setPadding(12f);
        Paragraph dateP = new Paragraph(dateExport, fontStats());
        dateP.setAlignment(Element.ALIGN_CENTER);
        Paragraph dateLbl = new Paragraph("Date d'export", fontStatsLabel());
        dateLbl.setAlignment(Element.ALIGN_CENTER);
        s2.addElement(dateP);
        s2.addElement(dateLbl);
        stats.addCell(s2);

        PdfPCell s3 = new PdfPCell();
        s3.setBackgroundColor(BG_LIGHT);
        s3.setBorderColor(BORDER_GREY);
        s3.setBorderWidth(1f);
        s3.setPadding(12f);
        Paragraph gen = new Paragraph("InnerTrack", fontStats());
        gen.setAlignment(Element.ALIGN_CENTER);
        Paragraph genLbl = new Paragraph("Genere par", fontStatsLabel());
        genLbl.setAlignment(Element.ALIGN_CENTER);
        s3.addElement(gen);
        s3.addElement(genLbl);
        stats.addCell(s3);

        doc.add(stats);
        doc.add(Chunk.NEWLINE);
    }

    static class FooterEvent extends PdfPageEventHelper {
        @Override
        public void onEndPage(PdfWriter writer, Document document) {
            PdfContentByte cb = writer.getDirectContent();
            String footerText = "InnerTrack — Gestion de Sante Mentale  |  Page " +
                    writer.getPageNumber() + "  |  " +
                    LocalDate.now().format(DateTimeFormatter.ofPattern("dd/MM/yyyy"));
            cb.setColorStroke(VIOLET_LIGHT);
            cb.setLineWidth(1f);
            cb.moveTo(document.leftMargin(), document.bottomMargin() - 5);
            cb.lineTo(document.right(), document.bottomMargin() - 5);
            cb.stroke();
            ColumnText.showTextAligned(cb, Element.ALIGN_CENTER,
                    new Phrase(footerText, fontFooter()),
                    (document.right() + document.leftMargin()) / 2,
                    document.bottomMargin() - 18, 0);
        }
    }

    public static void exportHabitudes(List<Habitude> habitudes, String path) throws Exception {
        Document document = new Document(PageSize.A4.rotate(), 30, 30, 30, 50);
        PdfWriter writer = PdfWriter.getInstance(document, new FileOutputStream(path));
        writer.setPageEvent(new FooterEvent());
        document.open();

        String dateExport = LocalDate.now().format(DateTimeFormatter.ofPattern("dd/MM/yy"));
        ajouterHeader(document, "Vos Habitudes",
                "Rapport complet de vos habitudes quotidiennes — InnerTrack",
                habitudes.size(), dateExport);

        Paragraph sectionTitle = new Paragraph("  Mes Habitudes", fontSectionTitle());
        sectionTitle.setSpacingBefore(4f);
        sectionTitle.setSpacingAfter(8f);
        document.add(sectionTitle);

        PdfPTable table = new PdfPTable(8);
        table.setWidthPercentage(100);
        table.setWidths(new float[] { 2f, 1.5f, 3f, 1.3f, 1.3f, 1.3f, 1.5f, 1.3f });
        table.setSpacingBefore(4f);

        table.addCell(headerCell("Nom"));
        table.addCell(headerCell("Emotion"));
        table.addCell(headerCell("Note"));
        table.addCell(headerCell("Energie"));
        table.addCell(headerCell("Stress"));
        table.addCell(headerCell("Sommeil"));
        table.addCell(headerCell("Date"));
        table.addCell(headerCell("Statut"));

        DateTimeFormatter fmt = DateTimeFormatter.ofPattern("dd/MM/yyyy");
        boolean pair = false;

        for (Habitude h : habitudes) {
            BaseColor rowBg = pair ? BG_LIGHT : WHITE;

            PdfPCell nomCell = textCell(h.getNomHabitude(), Element.ALIGN_LEFT, true);
            nomCell.setBackgroundColor(rowBg);
            table.addCell(nomCell);

            PdfPCell emoCell = textCell(h.getEmotionDominantes(), Element.ALIGN_CENTER, false);
            emoCell.setBackgroundColor(rowBg);
            table.addCell(emoCell);

            String note = h.getNoteTextuelle();
            PdfPCell noteCell = new PdfPCell();
            noteCell.setBackgroundColor(rowBg);
            noteCell.setBorderColor(BORDER_GREY);
            noteCell.setBorderWidth(0.5f);
            noteCell.setPadding(6f);
            noteCell.setNoWrap(false);
            Paragraph noteParagraph = new Paragraph(note != null ? note : "-", fontCell());
            noteParagraph.setLeading(13f);
            noteCell.addElement(noteParagraph);
            table.addCell(noteCell);

            table.addCell(badgeCell(h.getNiveauEnergie(), couleurEnergie(h.getNiveauEnergie()),
                    labelEnergie(h.getNiveauEnergie())));
            table.addCell(badgeCell(h.getNiveauStress(), couleurStress(h.getNiveauStress()),
                    labelStress(h.getNiveauStress())));
            table.addCell(badgeCell(h.getQualiteSommeil(), couleurSommeil(h.getQualiteSommeil()),
                    labelSommeil(h.getQualiteSommeil())));

            String dateStr = h.getDateCreation() != null ? h.getDateCreation().format(fmt) : "-";
            PdfPCell dateCell = textCell(dateStr, Element.ALIGN_CENTER, false);
            dateCell.setBackgroundColor(rowBg);
            table.addCell(dateCell);

            int moy = (h.getNiveauEnergie() + (10 - h.getNiveauStress()) + h.getQualiteSommeil()) / 3;
            BaseColor statC = moy >= 7 ? COLOR_GREEN : moy >= 4 ? COLOR_YELLOW : COLOR_RED;
            String statL = moy >= 7 ? "Excellent" : moy >= 4 ? "Moyen" : "A suivre";
            table.addCell(badgeCell(moy, statC, statL));

            pair = !pair;
        }

        document.add(table);
        document.close();
    }

    public static void exportJournal(List<EntreeJournal> entrees, String path) throws Exception {
        Document document = new Document(PageSize.A4, 40, 40, 30, 50);
        PdfWriter writer = PdfWriter.getInstance(document, new FileOutputStream(path));
        writer.setPageEvent(new FooterEvent());
        document.open();

        String dateExport = LocalDate.now().format(DateTimeFormatter.ofPattern("dd/MM/yy"));
        ajouterHeader(document, "Journal Intime",
                "Rapport de vos entrees emotionnelles — InnerTrack",
                entrees.size(), dateExport);

        Paragraph sectionTitle = new Paragraph("  Mes Entrees de Journal", fontSectionTitle());
        sectionTitle.setSpacingBefore(4f);
        sectionTitle.setSpacingAfter(8f);
        document.add(sectionTitle);

        PdfPTable table = new PdfPTable(3);
        table.setWidthPercentage(100);
        table.setWidths(new float[] { 1.5f, 5f, 1.5f });
        table.setSpacingBefore(4f);

        table.addCell(headerCell("Humeur"));
        table.addCell(headerCell("Note / Description"));
        table.addCell(headerCell("Date"));

        DateTimeFormatter fmt = DateTimeFormatter.ofPattern("dd/MM/yyyy");
        boolean pair = false;

        for (EntreeJournal e : entrees) {
            BaseColor rowBg = pair ? BG_LIGHT : WHITE;

            table.addCell(badgeCell(e.getHumeur(), couleurHumeur(e.getHumeur()), labelHumeur(e.getHumeur())));

            String note = e.getNoteTextuelle();
            PdfPCell noteCell = textCell(note != null ? note : "-", Element.ALIGN_LEFT, false);
            noteCell.setBackgroundColor(rowBg);
            noteCell.setPaddingTop(8f);
            noteCell.setPaddingBottom(8f);
            table.addCell(noteCell);

            String dateStr = e.getDateSaisie() != null ? e.getDateSaisie().format(fmt) : "-";
            PdfPCell dateCell = textCell(dateStr, Element.ALIGN_CENTER, false);
            dateCell.setBackgroundColor(rowBg);
            table.addCell(dateCell);

            pair = !pair;
        }

        document.add(table);
        document.close();
    }
}
