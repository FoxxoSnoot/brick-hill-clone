/**
 * MIT License
 *
 * Copyright (c) 2021-2022 FoxxoSnoot
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

var gameInfo = {};

$(() => {
    const gameInfoMeta = $('meta[name="game-info"]');
    gameInfo.id = gameInfoMeta.attr('data-id');
    gameInfo.launch = gameInfoMeta.attr('data-launch');

    $('#play').click(function() {
        console.log('Launching game...');

        $.get('/api/v1/auth/generateToken', { set: gameInfo.id }).done(() => window.location = gameInfo.launch);
    });

    $('[data-modal-open]').click(function() {
        $(`[data-modal="${$(this).attr('data-modal-open')}"]`).show();
    });

    $('[data-modal-close]').click(function() {
        $(`[data-modal="${$(this).attr('data-modal-close')}"]`).hide();
    });
});
