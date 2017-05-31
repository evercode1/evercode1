<?php

namespace App\UtilityTraits;

use Illuminate\Http\Request;

trait FormatsCode
{


    /**
     * @param Request $request
     * @return Request|mixed|string
     */
    private function formatPostBody(Request $request)
    {
        $request = html_entity_decode($request->body);

        $request = str_replace('&#39;', '\'', $request);

        $code = <<<EOT
<div class="pad-20">
 
<pre class="prettyprint">

EOT;

        $endCode = <<<EOT
        
</pre>

</div>
EOT;



        $request = str_replace('<pre class="html " data-pbcklang="html" data-pbcktabsize="4">', $code, $request);

        $request = str_replace('<pre class="php " data-pbcklang="php" data-pbcktabsize="4">', $code, $request);

        $request = str_replace('<pre class="css " data-pbcklang="css" data-pbcktabsize="4">', $code, $request);

        $request = str_replace('<pre class="javascript " data-pbcklang="javascript" data-pbcktabsize="4">', $code, $request);

        $request = str_replace('</pre>', $endCode, $request);

        return $request;
    }




}