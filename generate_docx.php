<?php
require_once 'PHPWord/vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

$fontSize = $_POST['fontSize'];
$bold = isset($_POST['bold']) ? true : false;
$italic = isset($_POST['italic']) ? true : false;
$text = $_POST['textInput'];

$phpWord = new PhpWord();
$section = $phpWord->addSection();
$section->addText($text, array('size' => $fontSize, 'bold' => $bold, 'italic' => $italic));

$filename = "formatted_text.docx";
$objWriter = IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save($filename);

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
readfile($filename);
unlink($filename);
