<?php

namespace TestCase\XmediaOne;

// facebook-webdriver
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

class Case1_1_1_1_1_1_1
{
    public function seqNo1() {
        /**
         * selenium facebook-webdriver 実行のサンプル
         */
        // selenium
        $host = 'http://localhost:4444/wd/hub';
        // chrome ドライバーの起動
        $driver = RemoteWebDriver::create($host,DesiredCapabilities::chrome());

        // 画面サイズをMAXに
        $driver->manage()->window()->maximize();
        // 指定URLへ遷移 (Google)
        $driver->get('https://www.google.co.jp/');
        // 検索Box
        $element = $driver->findElement(WebDriverBy::name('q'));
        // 検索Boxにキーワードを入力して
        $element->sendKeys('セレニウムで自動操作');
        // 検索実行
        $element->submit();

        // 検索結果画面のタイトルが 'セレニウムで自動操作 - Google 検索' になるまで10秒間待機する
        // 指定したタイトルにならずに10秒以上経ったら
        // 'Facebook\WebDriver\Exception\TimeOutException' がthrowされる
        $driver->wait(10)->until(
            WebDriverExpectedCondition::titleIs('セレニウムで自動操作 - Google 検索')
        );

        // セレニウムで自動操作 - Google 検索 というタイトルを取得できることを確認する
        if ($driver->getTitle() !== 'セレニウムで自動操作 - Google 検索') {
            throw new Exception('fail');
        }
        // キャプチャ
        $methodName = 'seqNo1';
        $date       = new \DateTime();
        $file       = 'screenshot/' . $date->format('y-m-d_') . $methodName . ".png";
        $driver->takeScreenshot($file);

        // ブラウザを閉じる
        $driver->close();
    }
}
