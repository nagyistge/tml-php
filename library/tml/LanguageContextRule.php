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

namespace tml;

use tml\rules_engine\Evaluator;
use tml\rules_engine\Parser;

class LanguageContextRule extends Base {

    /**
     * @var LanguageContext
     */
    public $language_context;

    /**
     * @var string
     */
    public $keyword;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $examples;

    /**
     * @var string
     */
    public $conditions;

    /*
     * string[]
     */
    public $conditions_expression;

    /**
     * @param array $attributes
     */
    function __construct($attributes=array()) {
        parent::__construct($attributes);
    }

    /**
     * @return bool
     */
    function isFallback() {
        return ($this->keyword == "other");
    }

    /**
     * @return array|int|string
     */
    function conditionsExpression() {
        if (!isset($this->conditions_expression)) {
            $p = new Parser($this->conditions);
            $this->conditions_expression = $p->parse();
        }
        return $this->conditions_expression;
    }

    /**
     * @param array $vars
     * @return bool|mixed
     */
    function evaluate($vars = array()) {
        if ($this->isFallback()) return true;

        $e = new Evaluator();
        foreach($vars as $key => $value) {
            $e->evaluate(array("let", $key, $value));
        }

        return $e->evaluate($this->conditionsExpression());
    }

}