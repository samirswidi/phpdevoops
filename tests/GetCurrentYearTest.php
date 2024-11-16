// tests/GetCurrentYearTest.php
<?php
use PHPUnit\Framework\TestCase;

class GetCurrentYearTest extends TestCase {
    public function testGetCurrentYear() {
        $currentYear = getCurrentYear();
        $this->assertEquals(date('Y'), $currentYear);
    }
}
?>
