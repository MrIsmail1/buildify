<?php

    class View
{
    public function renderSeo($seoTitle, $metaDescription)
    {
        
        echo "<html>";
        echo "<head>";
        echo "<title>" . htmlentities($seoTitle) . "</title>";
        echo "<meta name='description' content='" . htmlentities($metaDescription) . "'>";
        echo "</head>";
    }
}

?>