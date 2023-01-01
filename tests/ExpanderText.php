<?php

namespace alcamo\string;

use PHPUnit\Framework\TestCase;

class ExpanderText extends TestCase
{
    /**
     * @dataProvider expandProvider
     */
    public function testExpand($text, $data, $format, $expectedResult): void
    {
        $this->assertSame(
            $expectedResult,
            Expander::expand($text, $data, $format)
        );
    }

    public function expandProvider(): array
    {
        return [
            [
                'FOO ${FOO}${FOO}$(FOO) B {B}{X}',
                [ 'FOO' => 'Foo ', 'B' => 'bar' ],
                Expander::PSR3_FORMAT,
                'FOO $Foo $Foo $(FOO) B bar{X}'
            ],
            [
                'FOO ${FOO}${FOO}$(FOO) B ${B}${X}',
                [ 'FOO' => 'Foo ', 'B' => 'bar' ],
                Expander::BASH_FORMAT,
                'FOO Foo Foo $(FOO) B bar${X}'
            ],
            [
                'FOO ${FOO}${FOO}$(FOO) B ${B}$(B)',
                [ 'FOO' => 'Foo ', 'B' => 'bar' ],
                Expander::MAKE_FORMAT,
                'FOO ${FOO}${FOO}Foo  B ${B}bar'
            ]
        ];
    }
}
