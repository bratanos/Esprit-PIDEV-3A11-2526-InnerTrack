<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfExporter
{
    public function exportJournal(array $entrees, string $filename): void
    {
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $total = count($entrees);
        $avgHumeur   = $total > 0 ? round(array_sum(array_map(fn($e) => $e->getHumeur(), $entrees)) / $total, 1) : 0;
        $bestHumeur  = $total > 0 ? max(array_map(fn($e) => $e->getHumeur(), $entrees)) : 0;
        $worstHumeur = $total > 0 ? min(array_map(fn($e) => $e->getHumeur(), $entrees)) : 0;

        $html = '<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: "DejaVu Sans", sans-serif; font-size: 11px; color: #2d3748; background: #fff; }
    .header { background: #006876; color: white; padding: 24px 30px; border-radius: 12px; margin-bottom: 20px; }
    .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
    .brand { font-size: 22px; font-weight: bold; letter-spacing: 1px; }
    .brand-sub { font-size: 10px; opacity: 0.8; letter-spacing: 2px; text-transform: uppercase; }
    .header-title { font-size: 26px; font-weight: bold; margin-bottom: 4px; }
    .header-sub { font-size: 11px; opacity: 0.85; }
    .header-badge { background: rgba(255,255,255,0.2); padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: bold; }
    .stats-row { width: 100%; border-collapse: separate; border-spacing: 8px; margin-bottom: 20px; }
    .stat-cell { width: 25%; padding: 14px 10px; border-radius: 10px; text-align: center; border: none; }
    .stat-number { font-size: 26px; font-weight: bold; margin-bottom: 4px; }
    .stat-label { font-size: 10px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.75; }
    .section-title { font-size: 13px; font-weight: bold; color: #2d3748; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 2px solid #e2e8f0; }
    table.main-table { width: 100%; border-collapse: collapse; }
    table.main-table thead tr { background: #006876; color: white; }
    table.main-table th { padding: 10px 12px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold; text-align: left; }
    table.main-table tbody tr:nth-child(even) { background-color: #f0fafa; }
    table.main-table tbody tr:nth-child(odd) { background-color: #ffffff; }
    table.main-table td { padding: 10px 12px; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
    .date-text { color: #4a5568; font-weight: bold; font-size: 11px; }
    .badge { padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 10px; display: inline-block; }
    .note-text { color: #4a5568; line-height: 1.5; font-size: 10px; }
    .footer { margin-top: 24px; text-align: center; font-size: 9px; color: #aaa; border-top: 1px solid #e2e8f0; padding-top: 10px; }
    .footer strong { color: #006876; }
</style>

<div class="header">
    <div class="header-top">
        <div>
            <div class="brand">InnerTrack</div>
            <div class="brand-sub">Digital Sanctuary</div>
        </div>
        <div class="header-badge">' . date('d/m/Y a H:i') . '</div>
    </div>
    <div class="header-title">Mon Journal Emotionnel</div>
    <div class="header-sub">Rapport personnel confidentiel - ' . $total . ' entree(s) enregistree(s)</div>
</div>

<table class="stats-row">
    <tr>
        <td class="stat-cell" style="background:#e6f7f9;">
            <div class="stat-number" style="color:#006876;">' . $total . '</div>
            <div class="stat-label" style="color:#006876;">Total entrees</div>
        </td>
        <td class="stat-cell" style="background:#fefce8;">
            <div class="stat-number" style="color:#d97706;">' . $avgHumeur . '/10</div>
            <div class="stat-label" style="color:#d97706;">Humeur moyenne</div>
        </td>
        <td class="stat-cell" style="background:#f0fdf4;">
            <div class="stat-number" style="color:#38a169;">' . $bestHumeur . '/10</div>
            <div class="stat-label" style="color:#38a169;">Meilleure humeur</div>
        </td>
        <td class="stat-cell" style="background:#fff5f5;">
            <div class="stat-number" style="color:#e53e3e;">' . $worstHumeur . '/10</div>
            <div class="stat-label" style="color:#e53e3e;">Humeur la plus basse</div>
        </td>
    </tr>
</table>

<div class="section-title">Historique des entrees</div>

<table class="main-table">
    <thead>
        <tr>
            <th style="width:12%">Date</th>
            <th style="width:8%">Humeur</th>
            <th style="width:22%">Niveau</th>
            <th>Note du jour</th>
        </tr>
    </thead>
    <tbody>';

        foreach ($entrees as $e) {
            $v = $e->getHumeur();

            if ($v >= 8) {
                $couleur = '#38a169'; $label = 'Excellent';
            } elseif ($v >= 6) {
                $couleur = '#68d391'; $label = 'Bien';
            } elseif ($v >= 4) {
                $couleur = '#f6ad55'; $label = 'Moyen';
            } elseif ($v >= 2) {
                $couleur = '#fc8181'; $label = 'Difficile';
            } else {
                $couleur = '#e53e3e'; $label = 'Tres difficile';
            }

            $noteRaw = $e->getNoteTextuelle() ?? 'Aucune note.';
            $note = nl2br(htmlspecialchars(mb_substr($noteRaw, 0, 120)));
            if (mb_strlen($noteRaw) > 120) {
                $note .= '...';
            }

            $html .= '
    <tr>
        <td class="date-text">' . $e->getDateSaisie()->format('d/m/Y') . '</td>
        <td style="text-align:center; font-weight:bold; color:' . $couleur . ';">' . $v . '/10</td>
        <td>
            <span class="badge" style="background-color:' . $couleur . '22; color:' . $couleur . ';">
                ' . $label . '
            </span>
        </td>
        <td class="note-text">' . $note . '</td>
    </tr>';
        }

        $html .= '
    </tbody>
</table>

<div class="footer">
    Genere par <strong>InnerTrack</strong> — Digital Sanctuary &nbsp;|&nbsp; Rapport confidentiel &nbsp;|&nbsp; ' . date('Y') . '
</div>

</body>
</html>';

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        file_put_contents($filename, $dompdf->output());
    }

    public function exportHabitudes(array $habitudes, string $filename): void
    {
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $total      = count($habitudes);
        $avgEnergie = $total > 0 ? round(array_sum(array_map(fn($h) => $h->getNiveauEnergie(), $habitudes)) / $total, 1) : 0;
        $avgStress  = $total > 0 ? round(array_sum(array_map(fn($h) => $h->getNiveauStress(),  $habitudes)) / $total, 1) : 0;
        $avgSommeil = $total > 0 ? round(array_sum(array_map(fn($h) => $h->getQualiteSommeil(), $habitudes)) / $total, 1) : 0;

        $html = '<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: "DejaVu Sans", sans-serif; font-size: 11px; color: #2d3748; background: #fff; }
    .header { background: #5a3ea1; color: white; padding: 24px 30px; border-radius: 12px; margin-bottom: 20px; }
    .header-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
    .brand { font-size: 22px; font-weight: bold; letter-spacing: 1px; }
    .brand-sub { font-size: 10px; opacity: 0.8; letter-spacing: 2px; text-transform: uppercase; }
    .header-title { font-size: 26px; font-weight: bold; margin-bottom: 4px; }
    .header-sub { font-size: 11px; opacity: 0.85; }
    .header-badge { background: rgba(255,255,255,0.2); padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: bold; }
    .stats-row { width: 100%; border-collapse: separate; border-spacing: 8px; margin-bottom: 20px; }
    .stat-cell { width: 25%; padding: 14px 10px; border-radius: 10px; text-align: center; border: none; }
    .stat-number { font-size: 26px; font-weight: bold; margin-bottom: 4px; }
    .stat-label { font-size: 10px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; }
    .section-title { font-size: 13px; font-weight: bold; color: #2d3748; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 2px solid #e2e8f0; }
    table.main-table { width: 100%; border-collapse: collapse; }
    table.main-table thead tr { background: #5a3ea1; color: white; }
    table.main-table th { padding: 10px 12px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold; text-align: left; }
    table.main-table tbody tr:nth-child(even) { background-color: #f8f4ff; }
    table.main-table tbody tr:nth-child(odd) { background-color: #ffffff; }
    table.main-table td { padding: 10px 12px; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
    .date-text { color: #4a5568; font-weight: bold; font-size: 11px; }
    .badge { padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 10px; display: inline-block; }
    .note-text { color: #4a5568; line-height: 1.5; font-size: 10px; }
    .footer { margin-top: 24px; text-align: center; font-size: 9px; color: #aaa; border-top: 1px solid #e2e8f0; padding-top: 10px; }
    .footer strong { color: #5a3ea1; }
</style>

<div class="header">
    <div class="header-top">
        <div>
            <div class="brand">InnerTrack</div>
            <div class="brand-sub">Digital Sanctuary</div>
        </div>
        <div class="header-badge">' . date('d/m/Y a H:i') . '</div>
    </div>
    <div class="header-title">Mes Habitudes</div>
    <div class="header-sub">Rapport personnel confidentiel - ' . $total . ' habitude(s) enregistree(s)</div>
</div>

<table class="stats-row">
    <tr>
        <td class="stat-cell" style="background:#f3f0ff;">
            <div class="stat-number" style="color:#5a3ea1;">' . $total . '</div>
            <div class="stat-label" style="color:#5a3ea1;">Total</div>
        </td>
        <td class="stat-cell" style="background:#f0fdf4;">
            <div class="stat-number" style="color:#38a169;">' . $avgEnergie . '/10</div>
            <div class="stat-label" style="color:#38a169;">Energie moy.</div>
        </td>
        <td class="stat-cell" style="background:#fff7ed;">
            <div class="stat-number" style="color:#dd6b20;">' . $avgStress . '/10</div>
            <div class="stat-label" style="color:#dd6b20;">Stress moy.</div>
        </td>
        <td class="stat-cell" style="background:#faf5ff;">
            <div class="stat-number" style="color:#805ad5;">' . $avgSommeil . '/10</div>
            <div class="stat-label" style="color:#805ad5;">Sommeil moy.</div>
        </td>
    </tr>
</table>

<div class="section-title">Liste des habitudes</div>

<table class="main-table">
    <thead>
        <tr>
            <th>Habitude</th>
            <th>Date</th>
            <th>Emotion</th>
            <th>Energie</th>
            <th>Stress</th>
            <th>Sommeil</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>';

        foreach ($habitudes as $h) {
            $ce = $h->getNiveauEnergie() >= 7 ? '#48bb78' : ($h->getNiveauEnergie() >= 4 ? '#f6ad55' : '#ff4444');
            $cs = $h->getNiveauStress()  >= 7 ? '#ff4444' : ($h->getNiveauStress()  >= 4 ? '#f6ad55' : '#63b3ed');
            $co = $h->getQualiteSommeil() >= 7 ? '#b794f4' : ($h->getQualiteSommeil() >= 4 ? '#4299e1' : '#a0aec0');

            $noteRaw = $h->getNoteTextuelle() ?? '';
            $note    = htmlspecialchars(mb_substr($noteRaw, 0, 50));
            if (mb_strlen($noteRaw) > 50) $note .= '...';

            $html .= '
    <tr>
        <td><strong>' . htmlspecialchars($h->getNomHabitude()) . '</strong></td>
        <td class="date-text">' . $h->getDateCreation()->format('d/m/Y') . '</td>
        <td>' . htmlspecialchars($h->getEmotionDominantes()) . '</td>
        <td><span class="badge" style="background-color:' . $ce . '22;color:' . $ce . '">' . $h->getNiveauEnergie() . '/10</span></td>
        <td><span class="badge" style="background-color:' . $cs . '22;color:' . $cs . '">' . $h->getNiveauStress()  . '/10</span></td>
        <td><span class="badge" style="background-color:' . $co . '22;color:' . $co . '">' . $h->getQualiteSommeil() . '/10</span></td>
        <td class="note-text">' . ($note ?: '—') . '</td>
    </tr>';
        }

        $html .= '
    </tbody>
</table>

<div class="footer">
    Genere par <strong>InnerTrack</strong> — Digital Sanctuary &nbsp;|&nbsp; Rapport confidentiel &nbsp;|&nbsp; ' . date('Y') . '
</div>

</body>
</html>';

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        file_put_contents($filename, $dompdf->output());
    }
}