<?php

namespace Tests\Unit;

use App\Models\Profile;
use PHPUnit\Framework\TestCase;

class ProfileTest extends TestCase
{
    /** @dataProvider photoPathAttributeProvider */
    public function test_photo_path_attribute(string $photo, string $expected)
    {
        $profile = new Profile();
        $profile->photo = $photo;

        $this->assertSame($expected, $profile->photo_path);
    }

    public function photoPathAttributeProvider()
    {
        return [
            ['Happy', '/imgs/profiles/Happy.png'],
            ['Sad', '/imgs/profiles/Sad.png'],
            ['Surprised', '/imgs/profiles/Surprised.png'],
        ];
    }
}
