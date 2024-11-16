// tests/GetCurrentYearTest.php
<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../index.php'; // Adjust
class GetCurrentYearTest extends TestCase {
    public function testGetCurrentYear() {
        $currentYear = getCurrentYear();
        $this->assertEquals(date('Y'), $currentYear);
    }
}
?>
