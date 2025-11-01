<?php
require("fpdf.php");

class PDF extends FPDF {

    private $title = "Cantidad de Compras a Proveedores";
    private $companyName = "Zapateria JADEZ SA DE CV";
    private $companyDetails = "Venta de zapatos orginales con garantía. \n 2ª Calle PTE #14 San Salvador, San Salvador CP, 1701 - Tel: +503 2265-7847";

    // Encabezado
    function Header() {
        $this->Image("../src/img/prueba.png", 10, 8, 25); // Logo
        $this->SetFont("Arial", "B", 18);
        $this->SetTextColor(0, 0, 0); // Texto negro
        $this->Cell(0, 10, utf8_decode($this->companyName), 0, 1, "C");
        $this->SetFont("Arial", "", 11);
        $this->SetTextColor(50, 50, 50); // Gris oscuro
        $this->MultiCell(0, 6, utf8_decode($this->companyDetails), 0, "C");
        $this->Ln(8); // Espaciado
        $this->SetLineWidth(0.5);
        $this->SetDrawColor(0, 0, 0); // Línea negra
        $this->Line(10, 35, 290, 35);
        $this->Ln(12);
    }

    // Título del documento
    function DocumentTitle() {
        $this->SetFont("Arial", "B", 14);
        $this->SetTextColor(0, 0, 0); // Texto negro
        $this->Cell(0, 10, utf8_decode($this->title), 0, 1, "C");
        $this->Ln(5);
    }

    function PremiumTable($data) {
        
        $this->setX(40);
        
        // Encabezados de la tabla
        $header = ["#", "Proveedor", "Cantidad"];
        $widths = [30, 120, 60]; // Anchos de las columnas
    
        // Estilo de los encabezados
        $this->SetFont("Arial", "B", 12);
        $this->SetFillColor(255); // Blanco
        $this->SetTextColor(0);   // Negro
        $this->SetDrawColor(0);   // Bordes negros
    
        // Ajustar el grosor de las líneas (más delgadas)
        $this->SetLineWidth(0.1); // Grosor más delgado para las líneas de la tabla
    
        foreach ($header as $i => $col) {
            $this->Cell($widths[$i], 12, utf8_decode($col), 1, 0, "C", true);
        }
        $this->Ln();
    
        // Filas de datos
        $this->SetFont("Arial", "", 11);
        $fill = false; // Sin color de relleno inicialmente
        $contador = 1;
        foreach ($data as $row) {
            $this->setX(40);
            $this->SetFillColor(240, 240, 240); // Gris claro
            $this->SetTextColor(0); // Texto negro
            $this->Cell($widths[0], 10, utf8_decode($contador), "LR", 0, "C", $fill); // ID
            $this->Cell($widths[1], 10, utf8_decode($row['nombre']), "LR", 0, "L", $fill); // Nombre
            $this->Cell($widths[2], 10, utf8_decode($row['cantidad']), "LR", 0, "C", $fill); // Cantidad
            //$this->Cell($widths[3], 10, utf8_decode($row[3]), "LR", 0, "C", $fill); // Estado
            $this->Ln();
            $fill = !$fill; // Alternar relleno entre blanco y gris claro
            $contador++;
        }
    
        $this->setX(40);
        // Línea final para cerrar la tabla
        $this->Cell(array_sum($widths), 0, "", "T");
        
        // Total de proveedores
        $this->Ln(5);
        $this->SetFont("Arial", "B", 12);
        $this->SetFillColor(255); // Fondo blanco
        $this->SetTextColor(0); // Texto negro
        //$this->Cell($widths[0] + $widths[1] + $widths[2], 12, "Total de Proveedores", 1, 0, "R", true);
        //$this->Cell($widths[3], 12, count($data), 1, 0, "C", true);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont("Arial", "I", 10);
        $this->SetTextColor(50, 50, 50); // Gris oscuro
        date_default_timezone_set("America/El_Salvador");
        $fechaHora = date("d-m-Y h:i e");
        $this->Cell(0, 10, utf8_decode("Generado el: $fechaHora | Página ").$this->PageNo()."/{nb}", 0, 0, "C");
    }
}

// Incluir clases y obtener datos
include "../models/DaoProveedor.php"; // Asegúrate de que esta clase existe
require_once __DIR__ . '/../route.php'; //manejador de la url base

$dao = new DaoProveedor(); // Instancia de la clase DaoProveedor

// Crear PDF
$pdf = new PDF("L");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->DocumentTitle();
$pdf->PremiumTable($dao->compraProveedor()); // Llamada al método para obtener los datos
$pdf->Output();
?>
