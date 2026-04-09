<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfExporter
{
    public function exportJournal(array $entrees, string $filename): void
    {
        $options = new Options();
        // Utilisation de DejaVu Sans pour supporter les symboles comme l'étoile/soleil
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = '
        <style>
            body { font-family: "DejaVu Sans", sans-serif; font-size: 11px; color: #2d3748; }
            h1 { color: #5a3ea1; text-align: center; font-size: 20px; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
            table { width: 100%; border-collapse: collapse; }
            th { background-color: #f7fafc; color: #4a5568; font-size: 10px; padding: 12px; border-bottom: 2px solid #edf2f7; text-align: left; text-transform: uppercase; }
            td { padding: 12px; border-bottom: 1px solid #edf2f7; vertical-align: top; }
            
            .date-text { color: #718096; font-weight: bold; }
            
            /* Style des Badges identique à JavaFX */
            .badge {
                padding: 4px 10px;
                border-radius: 20px;
                font-weight: bold;
                font-size: 11px;
                display: inline-block;
                white-space: nowrap;
            }
            .note-box { line-height: 1.6; color: #2d3748; }
        </style>

        <h1>📓 Mon Journal de Bord (InnerTrack)</h1>

        <table>
            <thead>
                <tr>
                    <th style="width: 15%;">Date</th>
                    <th style="width: 25%;">Niveau d\'Humeur</th>
                    <th>Note Quotidienne</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($entrees as $e) {
            $v = $e->getHumeur();

            // Logique EXACTE de votre code JavaFX
            // v >= 7 ? "#f6a623" : v >= 4 ? "#48bb78" : "#2b6cb0"
            if ($v >= 7) {
                $couleur = "#f6a623";
                $emoji = "☀️";
                $label = "Joie";
            } elseif ($v >= 4) {
                $couleur = "#48bb78";
                $emoji = "🟢";
                $label = "Stable";
            } else {
                $couleur = "#2b6cb0";
                $emoji = "🔵";
                $label = "Triste";
            }

            $html .= '<tr>';
            $html .= '<td class="date-text">' . $e->getDateSaisie()->format('d/m/Y') . '</td>';
            $html .= '<td>
                        <span class="badge" style="background-color: ' . $couleur . '22; color: ' . $couleur . ';">
                            ' . $emoji . ' ' . $v . ' – ' . $label . '
                        </span>
                      </td>';
            $html .= '<td class="note-box">' . nl2br(htmlspecialchars($e->getNoteTextuelle() ?? 'Aucune note.')) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        file_put_contents($filename, $dompdf->output());
    }
}