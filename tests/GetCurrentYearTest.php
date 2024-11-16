<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../index.php'; // Make sure this path is correct

class GetCurrentYearTest extends TestCase {

    // Test for getCurrentYear() function
    public function testGetCurrentYear() {
        $currentYear = getCurrentYear();
        $this->assertEquals(date('Y'), $currentYear); // Asserting that the function returns the current year
    }

    // Test for getFullDate() function
    public function testGetFullDate() {
        $fullDate = getFullDate();
        $this->assertEquals(date('Y-m-d'), $fullDate); // Asserting that the function returns the full current date (YYYY-MM-DD)
    }
}
?>
