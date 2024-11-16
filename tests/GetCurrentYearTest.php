<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../index.php'; // emplacement des fichiers à tester

class GetCurrentYearTest extends TestCase {

    // Test for getCurrentYear() function
    public function testGetCurrentYear() {
        $currentYear = getCurrentYear();
        $this->assertEquals(date('Y'), $currentYear); 
    }

    // Test for getFullDate() function
    public function testGetFullDate() {
        $fullDate = getFullDate();
        $this->assertEquals(date('Y-m-d H:i:s'), $fullDate); 
    }
}
?>
