<?php

use PHPUnit\Framework\TestCase;

class StringsTest extends TestCase
{
    /**
     * @see https://www.php.net/manual/en/language.types.string.php
     */
    public function testVariableParsing()
    {
        $foo = 'world';

        // Double quotes.
        $this->assertEquals('Hello world', "Hello $foo");

        // Single quotes.
        $this->assertEquals('Hello $foo', 'Hello $foo');

        // TODO "Hello ${foo}"
        $this->assertEquals('Hello world', "Hello ${foo}");

        // TODO "Hello " . $foo
        $this->assertEquals('Hello world', "Hello " . $foo);

        // TODO Heredoc
        $this->assertEquals("Hello \n$foo", <<<Pronto
Hello 
$foo
Pronto);

        // TODO Nowdoc
        $this->assertEquals('Hello $foo',<<<'TODO'
Hello $foo
TODO);
    }

    /**
     * @see https://www.php.net/manual/en/ref.strings.php
     */
    public function testStringFunctions()
    {
        // trim — Strip whitespace (or other characters) from the beginning and end of a string
        $this->assertEquals('Hello', trim('Hello         '));
        $this->assertEquals('Hello', trim('Hello......', '.'));

        // ltrim — Strip whitespace (or other characters) from the beginning of a string
        $this->assertEquals('Hello', ltrim('  Hello'));

        // rtrim — Strip whitespace (or other characters) from the end of a string
        $this->assertEquals('Hello', rtrim('Hello+++','+'));

        // strtoupper — Make a string uppercase
        $this->assertEquals('HELLO', strtoupper('hello'));

        // strtolower — Make a string lowercase
        $this->assertEquals('hello', strtolower('HeLlO'));

        // ucfirst — Make a string's first character uppercase
        $this->assertEquals('Pronto', ucfirst('pronto'));

        // lcfirst — Make a string's first character lowercase
        $this->assertEquals('ratata',lcfirst('Ratata'));

        // strip_tags — Strip HTML and PHP tags from a string
        $this->assertEquals('Pronto drug Nu privet!<p>Gde ti ***** **********</p>', strip_tags('Pronto drug<a href="#"> Nu privet!</a><p>Gde ti ***** **********</p>','<p>'));

        // htmlspecialchars — Convert special characters to HTML entities
        $this->assertEquals('&lt;a href=&quot;#&quot;&gt; Barca!&lt;/a&gt;', htmlspecialchars('<a href="#"> Barca!</a>'));

        // addslashes — Quote string with slashes
        $this->assertEquals("Privetstvuu vas d\'Artgnan",addslashes("Privetstvuu vas d'Artgnan"));

        // strcmp — Binary safe string comparison
        $this->assertEquals('5', strcmp('first','airst'));

        // strncasecmp — Binary safe case-insensitive string comparison of the first n characters
        $this->assertEquals('0', strcasecmp('First','first'));

        // str_replace — Replace all occurrences of the search string with the replacement string
        $this->assertEquals('Nu chto tut skazat - eto velikolepno', str_replace('kapec','velikolepno','Nu chto tut skazat - eto kapec'));

        // strpos — Find the position of the first occurrence of a substring in a string
        $this->assertEquals('9', strpos('I didn\'t teach it', 'teach'));

        // strstr — Find the position of the first occurrence of a substring in a string
        $this->assertEquals('teacher', strstr('I am not a teacher', 'teach'));

        // strrchr — Find the last occurrence of a character in a string
        $this->assertEquals(':/usr/bin',strrchr('/bin:/sbin:/usr/bin', ':'));

        // substr — Return part of a string
        $this->assertEquals('/usr/bin', substr(strrchr('/bin:/sbin:/usr/bin',':'), 1));

        // sprintf — Return a formatted string
        $this->assertEquals('darova drug - tebe segodna 5', sprintf('darova %s - tebe segodna %d', 'drug', 5));
    }
}