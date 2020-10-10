<?php
require '../vendor/autoload.php';
use \Demo\HelloWorld as World;
use Demo\Hello\Lara;
use Demo\Hello;
$world = new World();
echo '<br>';
$lara= new Lara();
echo '<br>';
$vincent= new Hello\Someone('Vincent<br>');
// 以下Someone類別的使用可以不用use Demo\Hello;
$mary= new \Demo\Hello\Someone('Mary<br>');
$john= new Demo\Hello\Someone('John<br>');
echo '<br>';

//monolog usage
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('../log/your.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');

//nesbot carbon
use Carbon\Carbon;



printf("Right now is %s<br>", Carbon::now()->toDateTimeString());
echo '(這邊的時間是遵照程式碼下面設定的RFC2822(或ISO 8601)國際標準時間)<br><br>';
printf("Right now in Vancouver is %s<br>", Carbon::now('America/Vancouver'));  //implicit __toString()
echo '  (Vancouver目前的時間)<br><br>';
printf("台北目前時間： %s<br><br>", Carbon::now('Asia/Taipei'));  //implicit __toString() //時區設成台北
$tomorrow = Carbon::now()->addDay();
$lastWeek = Carbon::now()->subWeek();
$nextSummerOlympics = Carbon::createFromDate(2016)->addYears(4);

$officialDate = Carbon::now()->toRfc2822String();

$howOldAmI = Carbon::createFromDate(1975, 5, 21)->age;

$noonTodayLondonTime = Carbon::createFromTime(12, 0, 0, 'Europe/London');

$internetWillBlowUpOn = Carbon::create(2038, 01, 19, 3, 14, 7, 'GMT');

// Don't really want this to happen so mock now
Carbon::setTestNow(Carbon::createFromDate(2000, 1, 1));

// comparisons are always done in UTC
if (Carbon::now()->gte($internetWillBlowUpOn)) {
    die();
}

// Phew! Return to normal behaviour
Carbon::setTestNow();

if (Carbon::now()->isWeekend()) {
    echo 'Party!  (若有顯示Party表示今天為假日，若沒有則是平日)<br><br>';
}
// Over 200 languages (and over 500 regional variants) supported:
echo Carbon::now()->subMinutes(2)->diffForHumans(); // '2 minutes ago'
echo '<br>';
echo Carbon::now()->subMinutes(2)->locale('zh_TW')->diffForHumans(); // '2分鐘前'
echo '<br>(上面兩個都是時間的比較，只差在顯示的語言不同)<br><br>';
echo Carbon::parse('2019-07-23 14:51')->isoFormat('LLLL'); // 'Tuesday, July 23, 2019 2:51 PM'
echo '  (這是將24小時制改為12小時制)<br><br>';
echo Carbon::parse('2019-07-23 14:51')->locale('fr_FR')->isoFormat('LLLL'); // 'mardi 23 juillet 2019 14:51'
echo '  (這是法文，且顯示時間為固定)';
// ... but also does 'from now', 'after' and 'before'
// rolling up to seconds, minutes, hours, days, months, years

$daysSinceEpoch = Carbon::createFromTimestamp(0)->diffInDays();