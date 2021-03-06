<?php
/**
 * Copyright (c) 2015 Translation Exchange, Inc
 *
 *  _______                  _       _   _             ______          _
 * |__   __|                | |     | | (_)           |  ____|        | |
 *    | |_ __ __ _ _ __  ___| | __ _| |_ _  ___  _ __ | |__  __  _____| |__   __ _ _ __   __ _  ___
 *    | | '__/ _` | '_ \/ __| |/ _` | __| |/ _ \| '_ \|  __| \ \/ / __| '_ \ / _` | '_ \ / _` |/ _ \
 *    | | | | (_| | | | \__ \ | (_| | |_| | (_) | | | | |____ >  < (__| | | | (_| | | | | (_| |  __/
 *    |_|_|  \__,_|_| |_|___/_|\__,_|\__|_|\___/|_| |_|______/_/\_\___|_| |_|\__,_|_| |_|\__, |\___|
 *                                                                                        __/ |
 *                                                                                       |___/
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Tml;

require_once(__DIR__."/../BaseTest.php");

class TranslationTest extends \BaseTest {

    public function testMatchingWithOneToken() {
        $russian = new Language(self::loadJSON('languages/ru.json'));
        $one = new Translation(array("label" => "You have {count||message}", "context" => array("count" => array("number" => "one")), "language" => $russian));

        foreach(array(1, 101, 1001) as $count) {
            $this->assertTrue(
                $one->isValidTranslation(array("count" => $count))
            );
        }

        foreach(array(2, 22, 32, 102, 132) as $count) {
            $this->assertFalse(
                $one->isValidTranslation(array("count" => $count))
            );
        }

        $few = new Translation(array("label" => "You have {count||message}", "context" => array("count" => array("number" => "few")), "language" => $russian));

        foreach(array(2, 22, 32, 102, 132) as $count) {
            $this->assertTrue(
                $few->isValidTranslation(array("count" => $count))
            );
        }

        foreach(array(1, 101, 1001) as $count) {
            $this->assertFalse(
                $few->isValidTranslation(array("count" => $count))
            );
        }
    }

    public function testMatchingWithMultipleTokens() {
        $russian = new Language(self::loadJSON('languages/ru.json'));

        $t = new Translation(array("label" => "{user} received {count||message}",
            "context" => array(
                "user" => array("gender" => "male"),
                "count" => array("number" => "one"),
            ), "language" => $russian));

        $this->assertTrue(
            $t->isValidTranslation(array("count" => 1, "user" => new \User("Michael", "male")))
        );

        $this->assertFalse(
            $t->isValidTranslation(array("count" => 1, "user" => new \User("Anna", "female")))
        );

        $this->assertFalse(
            $t->isValidTranslation(array("count" => 10, "user" => new \User("Michael", "male")))
        );

    }

}
