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

class LanguageCaseRuleTest extends \BaseTest {

    protected $app, $russian, $english;

    protected function setUp() {
        $this->app = new Application(self::loadJSON('application.json'));
        $this->english = $this->app->addLanguage(new Language(self::loadJSON('languages/en.json')));
        $this->russian = $this->app->addLanguage(new Language(self::loadJSON('languages/ru.json')));
    }

    public function testEvaluation() {
        $case = $this->english->languageCase("plural");
        /** @var LanguageCaseRule $rule */
        $rule = $case->rules[0];
        $this->assertEquals(
            "(in 'sheep,fish,series,species,money,rice,information,equipment' @value)",
            $rule->conditions
        );

        $this->assertTrue(
            $rule->evaluate('sheep')
        );

        $this->assertEquals(
            "sheep",
            $rule->apply('sheep')
        );

        $this->assertTrue(
            $rule->evaluate('information')
        );

        $this->assertFalse(
            $rule->evaluate('horse')
        );
    }

    public function testApplication() {
        $case = $this->english->languageCase("times");
        $rule = $case->rules[0];
        $this->assertEquals(
            "(= 1 @value)",
            $rule->conditions
        );

        $this->assertTrue(
            $rule->evaluate(1)
        );

        $this->assertFalse(
            $rule->evaluate(2)
        );

        $this->assertEquals(
            'once',
            $rule->apply(1)
        );
    }
}

