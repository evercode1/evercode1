<?php

namespace App\UtilityTraits;

use Illuminate\Http\Request;

trait FormatsCode
{
    /**
     * @param Request $request
     * @return Request|mixed|string
     */

    private function formatPostBody($body)
    {

        // transform double braces to {% %} tokens

        $body = $this->transformBraces($body);

        list($code, $endCode) = $this->formatReplacementTags();

        $body = $this->replaceCKEditorCodeTags($code, $body);

        $body = $this->addEndingDivs($endCode, $body);

        return $body;

    }

    public function formatsEditedCode($body)
    {

        // transform double braces to {% %} tokens

        $body = $this->transformBraces($body);


        // create the strings to replace in body

        list($code, $endCode, $pad) = $this->formatsEditedTags();

        // set placeholder

        $placeholder = '<placeholder>';

        // fixes new code, same as in formatPostBody

        $body = $this->replaceCKEditorCodeTags($code, $body);

        // fixes old code, adds the pad above the pre prettyprint class
        // because CK editor for some reason strips it out in edit form

        $body = str_replace('<pre class="prettyprint">', $pad, $body);

        // strips out all </pre> tags and replaces with placeholder
        // because we need to make sure we have the ending div after all of them

        $body = str_replace('</pre>', $placeholder, $body);

        // adds the ending div below all closing </pre> tags

        $body = str_replace('<placeholder>', $endCode, $body);

        return $body;

    }

    /**
     * @param Request $request
     * @return mixed|string
     */

    private function transformBraces($body)
    {

        $body = str_replace('{{', '{%', $body);

        $body = str_replace('}}', '%}', $body);

        return $body;
    }

    /**
     * @param $code
     * @param $body
     * @return mixed
     */

    private function replaceCKEditorCodeTags($code, $body)
    {

        $body = str_replace('<pre data-pbcklang="" data-pbcktabsize="">', $code, $body);

        $body = str_replace('<pre class="php " data-pbcklang="php" data-pbcktabsize="">', $code, $body);

        $body = str_replace('<pre class="html " data-pbcklang="html" data-pbcktabsize="">', $code, $body);

        $body = str_replace('<pre class="css " data-pbcklang="css" data-pbcktabsize="">', $code, $body);

        $body = str_replace('<pre class="javascript " data-pbcklang="javascript" data-pbcktabsize="">', $code, $body);

        $body = str_replace('<pre class="html " data-pbcklang="html" data-pbcktabsize="4">', $code, $body);

        $body = str_replace('<pre class="php " data-pbcklang="php" data-pbcktabsize="4">', $code, $body);

        $body = str_replace('<pre class="css " data-pbcklang="css" data-pbcktabsize="4">', $code, $body);

        $body = str_replace('<pre class="javascript " data-pbcklang="javascript" data-pbcktabsize="4">', $code, $body);

        return $body;
    }

    /**
     * @return array
     */

    private function formatReplacementTags()
    {
        $code = <<<EOT
<div class="pad-20">
 
<pre class="prettyprint">

EOT;

        $endCode = <<<EOT
        
</pre>

</div>
EOT;
        return [$code,$endCode];

}

    private function formatsEditedTags()
    {
        $code = <<<EOT
 
<pre class="prettyprint">

EOT;

        $endCode = <<<EOT
        
</pre>

</div>


EOT;

        $pad = <<<EOT
        
<div class="pad-20">
 
<pre class="prettyprint">

EOT;

        return [$code, $endCode, $pad];

    }

    /**
     * @param $endCode
     * @param $body
     * @return mixed
     */

    private function addEndingDivs($endCode, $body)
    {
        return str_replace('</pre>', $endCode, $body);
    }

}