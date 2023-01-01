<?php

namespace alcamo\string;

use PHPUnit\Framework\TestCase;

class ExpanderText extends TestCase
{
    /**
     * @dataProvider expandProvider
     */
    public function testExpand($data, $format, $text, $expectedResult): void
    {
        $expander = new Expander($data, $format);

        $this->assertSame(
            $expectedResult,
            $expander->expand($text)
        );
    }

    public function expandProvider(): array
    {
        return [
            [
                [ 'FOO' => 'Foo ', 'B' => 'bar' ],
                Expander::PSR3_FORMAT,
                'FOO ${FOO}${FOO}$(FOO) B {B}{X}',
                'FOO $Foo $Foo $(FOO) B bar{X}'
            ],
            [
                [ 'FOO' => 'Foo ', 'B' => 'bar' ],
                Expander::BASH_FORMAT,
                'FOO ${FOO}${FOO}$(FOO) B ${B}${X}',
                'FOO Foo Foo $(FOO) B bar${X}'
            ],
            [
                [ 'FOO' => 'Foo ', 'B' => 'bar' ],
                Expander::MAKE_FORMAT,
                'FOO ${FOO}${FOO}$(FOO) B ${B}$(B)',
                'FOO ${FOO}${FOO}Foo  B ${B}bar'
            ]
        ];
    }
}
