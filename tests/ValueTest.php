<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\Value\Test;

use Borobudur\ValueObject\DateTime\Date\Month;
use Borobudur\ValueObject\DateTime\Date\MonthDay;
use Borobudur\ValueObject\DateTime\Date\WeekDay;
use Borobudur\ValueObject\DateTime\Date\Year;
use Borobudur\ValueObject\DateTime\DateTime;
use Borobudur\ValueObject\DateTime\DateTimeWithTimeZone;
use Borobudur\ValueObject\DateTime\Time\Hour;
use Borobudur\ValueObject\DateTime\Time\Minute;
use Borobudur\ValueObject\DateTime\Time\Second;
use Borobudur\ValueObject\DateTime\Time\Time;
use Borobudur\ValueObject\DateTime\TimeZone;
use Borobudur\ValueObject\Person\Name;
use Borobudur\ValueObject\StringLiteral\StringLiteral;
use Borobudur\ValueObject\Web\Email;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class ValueTest extends \PHPUnit_Framework_TestCase
{
    public function testEmail()
    {
        $email = new Email(StringLiteral::fromString('iq.bluejack@gmail.com'));
        
        $this->assertFalse($email->equal('iq.bluejack@gmail.com'));
        $this->assertFalse($email->equal(StringLiteral::fromString('iq.bluejack@gmail.com')));
        $this->assertTrue($email->equal(Email::fromString('iq.bluejack@gmail.com')));
    }

    public function testName()
    {
        $name1 = Name::fromString('Iqbal Maulana');
        $this->assertTrue($name1->first->equal(StringLiteral::fromString('Iqbal')));
        $this->assertTrue($name1->last->equal(StringLiteral::fromString('Maulana')));
        $this->assertTrue($name1->middle->isEmpty());
        $this->assertTrue($name1->getFullName()->equal(StringLiteral::fromString('Iqbal Maulana')));
        $this->assertSame('Iqbal Maulana', (string) $name1);

        $name2 = Name::fromString('Iqbal Maulana Zaini');
        $this->assertTrue($name2->first->equal(StringLiteral::fromString('Iqbal')));
        $this->assertTrue($name2->middle->equal(StringLiteral::fromString('Maulana')));
        $this->assertTrue($name2->last->equal(StringLiteral::fromString('Zaini')));
        $this->assertTrue($name2->getFullName()->equal(StringLiteral::fromString('Iqbal Maulana Zaini')));
        $this->assertSame('Iqbal Maulana Zaini', (string) $name2);

    }

    public function testDate()
    {
        $dateTimeString = '2014-05-01 07:30:05';
        $dateTime = DateTime::fromString($dateTimeString);

        $this->assertTrue($dateTime->date->year->equal(Year::cast(2014)));
        $this->assertTrue($dateTime->date->month->equal(Month::cast(Month::MAY)));
        $this->assertSame($dateTime->date->month->getNumericValue(), 5);

        $this->assertTrue($dateTime->time->hour->equal(Hour::cast(7)));
        $this->assertTrue($dateTime->time->minute->equal(Minute::cast(30)));
        $this->assertTrue($dateTime->time->second->equal(Second::cast(5)));
        $this->assertTrue($dateTime->time->equal(Time::fromString('07:30:05')));
        $this->assertSame((string) $dateTime->time, '07:30:05');

        $this->assertTrue($dateTime->date->day->equal(MonthDay::cast(1)));
        $this->assertTrue($dateTime->date->weekDay->equal(WeekDay::cast(WeekDay::THURSDAY)));
        $this->assertSame($dateTimeString, (string) $dateTime);
    }

    public function testDateTimeZone()
    {
        $dateTimeZoneString = '2014-05-01 07:30:05 Asia/Jakarta';
        $dateTimeZone = DateTimeWithTimeZone::fromString($dateTimeZoneString);

        $this->assertTrue($dateTimeZone->timeZone->equal(TimeZone::fromString('Asia/Jakarta')));
        $this->assertSame((string) $dateTimeZone->timeZone, 'Asia/Jakarta');
        $this->assertSame($dateTimeZone->timeZone->toNativeDateTimeZone()->getName(), 'Asia/Jakarta');
        $this->assertSame($dateTimeZoneString, (string) $dateTimeZone);
    }
}

