<html>
<head>
    <title>
        O2System Gear - Print Out
    </title>

    <style type="text/css">
        <?php echo preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__.'/assets/css/print-out.css')); ?>
    </style>
</head>
<body>
<div id="gear-toolbar">
    <img
        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAKN2lDQ1BzUkdCIElFQzYxOTY2LTIuMQAAeJydlndUU9kWh8+9N71QkhCKlNBraFICSA29SJEuKjEJEErAkAAiNkRUcERRkaYIMijggKNDkbEiioUBUbHrBBlE1HFwFBuWSWStGd+8ee/Nm98f935rn73P3Wfvfda6AJD8gwXCTFgJgAyhWBTh58WIjYtnYAcBDPAAA2wA4HCzs0IW+EYCmQJ82IxsmRP4F726DiD5+yrTP4zBAP+flLlZIjEAUJiM5/L42VwZF8k4PVecJbdPyZi2NE3OMErOIlmCMlaTc/IsW3z2mWUPOfMyhDwZy3PO4mXw5Nwn4405Er6MkWAZF+cI+LkyviZjg3RJhkDGb+SxGXxONgAoktwu5nNTZGwtY5IoMoIt43kA4EjJX/DSL1jMzxPLD8XOzFouEiSniBkmXFOGjZMTi+HPz03ni8XMMA43jSPiMdiZGVkc4XIAZs/8WRR5bRmyIjvYODk4MG0tbb4o1H9d/JuS93aWXoR/7hlEH/jD9ld+mQ0AsKZltdn6h21pFQBd6wFQu/2HzWAvAIqyvnUOfXEeunxeUsTiLGcrq9zcXEsBn2spL+jv+p8Of0NffM9Svt3v5WF485M4knQxQ143bmZ6pkTEyM7icPkM5p+H+B8H/nUeFhH8JL6IL5RFRMumTCBMlrVbyBOIBZlChkD4n5r4D8P+pNm5lona+BHQllgCpSEaQH4eACgqESAJe2Qr0O99C8ZHA/nNi9GZmJ37z4L+fVe4TP7IFiR/jmNHRDK4ElHO7Jr8WgI0IABFQAPqQBvoAxPABLbAEbgAD+ADAkEoiARxYDHgghSQAUQgFxSAtaAYlIKtYCeoBnWgETSDNnAYdIFj4DQ4By6By2AE3AFSMA6egCnwCsxAEISFyBAVUod0IEPIHLKFWJAb5AMFQxFQHJQIJUNCSAIVQOugUqgcqobqoWboW+godBq6AA1Dt6BRaBL6FXoHIzAJpsFasBFsBbNgTzgIjoQXwcnwMjgfLoK3wJVwA3wQ7oRPw5fgEVgKP4GnEYAQETqiizARFsJGQpF4JAkRIauQEqQCaUDakB6kH7mKSJGnyFsUBkVFMVBMlAvKHxWF4qKWoVahNqOqUQdQnag+1FXUKGoK9RFNRmuizdHO6AB0LDoZnYsuRlegm9Ad6LPoEfQ4+hUGg6FjjDGOGH9MHCYVswKzGbMb0445hRnGjGGmsVisOtYc64oNxXKwYmwxtgp7EHsSewU7jn2DI+J0cLY4X1w8TogrxFXgWnAncFdwE7gZvBLeEO+MD8Xz8MvxZfhGfA9+CD+OnyEoE4wJroRIQiphLaGS0EY4S7hLeEEkEvWITsRwooC4hlhJPEQ8TxwlviVRSGYkNimBJCFtIe0nnSLdIr0gk8lGZA9yPFlM3kJuJp8h3ye/UaAqWCoEKPAUVivUKHQqXFF4pohXNFT0VFysmK9YoXhEcUjxqRJeyUiJrcRRWqVUo3RU6YbStDJV2UY5VDlDebNyi/IF5UcULMWI4kPhUYoo+yhnKGNUhKpPZVO51HXURupZ6jgNQzOmBdBSaaW0b2iDtCkVioqdSrRKnkqNynEVKR2hG9ED6On0Mvph+nX6O1UtVU9Vvuom1TbVK6qv1eaoeajx1UrU2tVG1N6pM9R91NPUt6l3qd/TQGmYaYRr5Grs0Tir8XQObY7LHO6ckjmH59zWhDXNNCM0V2ju0xzQnNbS1vLTytKq0jqj9VSbru2hnaq9Q/uE9qQOVcdNR6CzQ+ekzmOGCsOTkc6oZPQxpnQ1df11Jbr1uoO6M3rGelF6hXrtevf0Cfos/ST9Hfq9+lMGOgYhBgUGrQa3DfGGLMMUw12G/YavjYyNYow2GHUZPTJWMw4wzjduNb5rQjZxN1lm0mByzRRjyjJNM91tetkMNrM3SzGrMRsyh80dzAXmu82HLdAWThZCiwaLG0wS05OZw2xljlrSLYMtCy27LJ9ZGVjFW22z6rf6aG1vnW7daH3HhmITaFNo02Pzq62ZLde2xvbaXPJc37mr53bPfW5nbse322N3055qH2K/wb7X/oODo4PIoc1h0tHAMdGx1vEGi8YKY21mnXdCO3k5rXY65vTW2cFZ7HzY+RcXpkuaS4vLo3nG8/jzGueNueq5clzrXaVuDLdEt71uUnddd457g/sDD30PnkeTx4SnqWeq50HPZ17WXiKvDq/XbGf2SvYpb8Tbz7vEe9CH4hPlU+1z31fPN9m31XfKz95vhd8pf7R/kP82/xsBWgHcgOaAqUDHwJWBfUGkoAVB1UEPgs2CRcE9IXBIYMj2kLvzDecL53eFgtCA0O2h98KMw5aFfR+OCQ8Lrwl/GGETURDRv4C6YMmClgWvIr0iyyLvRJlESaJ6oxWjE6Kbo1/HeMeUx0hjrWJXxl6K04gTxHXHY+Oj45vipxf6LNy5cDzBPqE44foi40V5iy4s1licvvj4EsUlnCVHEtGJMYktie85oZwGzvTSgKW1S6e4bO4u7hOeB28Hb5Lvyi/nTyS5JpUnPUp2Td6ePJninlKR8lTAFlQLnqf6p9alvk4LTduf9ik9Jr09A5eRmHFUSBGmCfsytTPzMoezzLOKs6TLnJftXDYlChI1ZUPZi7K7xTTZz9SAxESyXjKa45ZTk/MmNzr3SJ5ynjBvYLnZ8k3LJ/J9879egVrBXdFboFuwtmB0pefK+lXQqqWrelfrry5aPb7Gb82BtYS1aWt/KLQuLC98uS5mXU+RVtGaorH1futbixWKRcU3NrhsqNuI2ijYOLhp7qaqTR9LeCUXS61LK0rfb+ZuvviVzVeVX33akrRlsMyhbM9WzFbh1uvb3LcdKFcuzy8f2x6yvXMHY0fJjpc7l+y8UGFXUbeLsEuyS1oZXNldZVC1tep9dUr1SI1XTXutZu2m2te7ebuv7PHY01anVVda926vYO/Ner/6zgajhop9mH05+x42Rjf2f836urlJo6m06cN+4X7pgYgDfc2Ozc0tmi1lrXCrpHXyYMLBy994f9Pdxmyrb6e3lx4ChySHHn+b+O31w0GHe4+wjrR9Z/hdbQe1o6QT6lzeOdWV0iXtjusePhp4tLfHpafje8vv9x/TPVZzXOV42QnCiaITn07mn5w+lXXq6enk02O9S3rvnIk9c60vvG/wbNDZ8+d8z53p9+w/ed71/LELzheOXmRd7LrkcKlzwH6g4wf7HzoGHQY7hxyHui87Xe4Znjd84or7ldNXva+euxZw7dLI/JHh61HXb95IuCG9ybv56Fb6ree3c27P3FlzF3235J7SvYr7mvcbfjT9sV3qID0+6j068GDBgztj3LEnP2X/9H686CH5YcWEzkTzI9tHxyZ9Jy8/Xvh4/EnWk5mnxT8r/1z7zOTZd794/DIwFTs1/lz0/NOvm1+ov9j/0u5l73TY9P1XGa9mXpe8UX9z4C3rbf+7mHcTM7nvse8rP5h+6PkY9PHup4xPn34D94Tz+49wZioAAAAJcEhZcwAALiMAAC4jAXilP3YAAAtSSURBVHicxVoLcFPHFd19evpggyHYxm7DoEACpaZqkYVsUpoWHCyMZTMp304SQmkoHzeENi0pZTqTSUPSBtqSX0ObyQQC9JOUpAV/MS4mMGkAWwZK4vJpIGZIIPhTGIwNlqztudJ70pMsybKsNHfGfvveW+2es3v37t17nyyEYMkQp9M5mnM+QwieyzmbyBifgMcj8DdUqdKJv6uMiTPo8hTnogl911dWVl5MRv/yYH5cUlJiZkxajOL9nOu+TM9AIpqM9P/xcahThKuvbknJnH/j+Z8Y8+6oqKhoSRRLQkRmzSqdrNfzn4HEfNxKiXauCA3AU2jmSZDa5XaLX+7dW358oI0MiEhhYWGWwTBkI0jQLEQZe3EG/96H+pyFql2B+pBKYfT5UJRHYRbG4/YriupphQZkIdpe4HTO2dHT0/34vn37Pk06ETT+HaNxyBbm13uteAF+v9fL/tjTw/fV1ZV/HE97M2fOud1gEIWSxB4AqQIWnFlwZg+hrznoc1Vl5Z6/JIWIxWIxmM1jX0DjK8Je3QKB14XwbsSC/TCezrRSV7eHCG+jPxiKOzmXHgeHJbg3KlVGoM8/Q92mt7Scf/TkyZM9CRMpKCgYChJvo1gY+kZU9vSwR2try8/F+n17Ts4wYUizch2zcybsTLB2jPdp2Ml/1h87emy+19tL9ZSBWOFwlD5rMLAXQMipaWYFMIwDlrn79+/vHDARIpGSMrQWxbs1j29Az39QWVn+eiwCqqQ3N1/H5SD9nb/LPnxYmu570J/1WFxZBVZ7W0du/puit/e19BONLqqvDEyJ01m6BPr1O5RTlaYKCQswOaKRiUhEUaddYSRaenvdzurq6g/iIREuY//TcA2XzSD0Wlqa9ByAfhfmoozLclmHbWq1x+NZN+pE47+oLg3U7NmzG3U6fSVuzUoTd4PMLmCbE0nNIhIZM2bs87jM0jxqvnmTOerqquNayHEQWtpmnXoSC/3XzG/9ZsuyXNiRO3XzZfeNn+cAKA0YDMI0k4mRVuQoP5+lYFvVLxFYikVYZCs1j1r8JPYMmoRWMo4d/m2HLR+7Pn8ygIWztdmG1G915ObOHdnU9DH1CTIOkHmXKTND2IDxAKzZG1GJFBUVjZJlwxbNoxukTsmYiUjy4rGGDautdsw8/7rmcR7jhnfbbLbCDJfrLJGBmjmhZkeYsmZAZguw1tfU1FyJSESnM2zC5Tb1Hpta2UDWhN1u12dmZmKnllPd7u5z/W1oT3i93jZb/noYgANhr8wS09e222zT0l2uTwgDZqEMBFQjc5uCdUkfIorbsTjYloBVLN9OJdh545UrV3QNDQ1dkQBJksQxaD/OyvoC3BafT8WwocGPKq3DPrMy1j6T4TryDhb7eRTHhr26gzP935otlntozUCVtqO9happBqnFwLxZdWcCRPR6tp4F3Y6bHo97tQbq0wC5FJvTK1gvL4Wvl+Likt/g8qO+MPlMOJMH4dp8FbPTHo0MBg1rgIcTIcnLNqQ8g+tP6IYwQfXvRdFEjSuYFwaIFBcX3yFJ8rxAs0Jshf7RKKkz9UMUdfhbh4X3GEbmTexlm6uqqprgAU8B0QgkAvJFvd70fVx/FZUG4y3RnWa+pjU3f2dm05HjhAl7zFaYbsVq8XmEHTg+8hEBiQdZ0NfpxQLfpDYDEhsVEqoY0MCD9BvM0AEhpJ4Yrjvzt8/vjF1DeKP6oBhsifNnmbIdEDbMynIFk6Rg36Cq1gOaRuvV2VBGO8w9CZHp/ZHwtSjE6VjvuWDZ0Xn4KDravzbFRh4AYYNG1JPaarBvkB0OxxiDwTRR/RF5sUEA0vJ4gPYjcFO8sV0azm39NQIPYBkuPleGMGIzVYlMJA6yXm+cof0BueJ0xZzpsIjnsUGK1yvWVVVVtkZ7f3nSFLPBJFvjaGrBLkl6hBxNwmgyBV8QBxkjrh2Ns6pFwiZkZ4opTVSwD/29pqZyS6w6epOORjqeeU+fMdmei2sDYcT6PIsyHdLIFNtkIfiXguojTqolmM38xOAHpKm7u3Mx9ryo0Y2LFsvIFEPqI/E2CGtFTmyD/46wch8R4kAzorEo/IxawmhOHMT6OOf1ekpinR9IUvQpZJLDT5zRRYiJwZsgVuIghzXUqnk5Ou4OQuWSEL0O2PZLsSq12fKKJS4tG1DLoZi0624EERmm3mEWrmvKwxKYkQ6PhzmwLmIefZUFvo3FtzaCIngIVg2+YYOKa4VJJ2bCCRLvx6pEJ8W0NJkOTJlJ7NvnotAspNMNGAYYo3w92o8iyC2M0H1wDg/HqvSp1Zo6fLixHMVJiYDFzhnApMUKuU5ErjKFCAsdpXjPIB4Ypvurqsr/EavSRbN5SEpG9m4U74mz3b4imDa8qsV6FeaXfRi0XEITNPM2xxFEJNO6HCTejlXp0mh7SkpW9h6M470DgN1XOD+l6XqCusSIA8wv+UHcodS0BKoJcbS/xY46j+HMsjVWHSJhzNKROhUkhj6kv/eCd0GsxIFmxKUBPJ4igLRz4lTWABelg0XZ3dHoL0DiuVgdJ5MEpL3+eEMTBZsJI1yU8UEszCW73bfq4TQGalMYE5dt2JF74WXuAt/lEUi8BBJPxOqVFrZxlLECxelJIEHyVzWg58cYHH3iINfW1l6A30K659s1/bFYXygTJzL2iiyzECJgv726unJNf71e7+rypErygnhRGoxSOtdximsZIr0XHs+ralnBqMop4qDuI+S6P+Uv8hlFRUVjye+vqSl34dBfC9VT1pDY091942HMlrc/YHedPn2L+eLD8Um7derDUUkwVqtGIwkbDlZaj9137PARgV+0Eyctii+RmdLpdPq1uJb56/WuwyNYG3Gwq+vGIvhPnnjBxSvvoHOLNa8symuPV4ifqjcKNvXE6iXsASJ05sV6eAuz4VMFeJlLwXwTzQo2uWM4Ka68du3aG4cOHbqZbBIkFuuU+3AZE/mteJ7O61RSZmOp5t1bhD1AhMTtZs/o9YyMAq0ikyzrX8S1hN5VVFS8yj5TkVZHeXH0ck/XetVsKphUyyQIs1oxQITiQ5QpoiSL/wl34v4hiiclH3hQWnPzJ+s4/2aEVx8J5v52jhKwJizQlEC6AUZnhzZFF+I09vb2rMXUlTIl2ghSL+Ok6FKjjRSIa7XmreBMmFmSRMd4JJelxcvcjgyX6xO6AYZJWBsva97/l7BqfxBChGKplO4CATXdlUqhfYqK0yZJp722Sfbd3CjtBkt7Upj09R6OMtEzN6Opyefr+Tc/X3pBzZXQbKzSxn37ECGhKDfITNdE5M0U2qeoOJHJ+KDhUrPF8o1sfcrTIEOBOV14GwmKB3Y2kFYIkvClFQIaABK/D4/ERyRCcuHC+TVm81gKYao5khwK7VNUnNRM6Whtq822UxL6TSAdK/YVjwQSPerCJnVSZkKrxnsJW6QGIhKhjFBBQcH8sNSbmUL7TmdpIPWW6XKdYBQ8s02dAg3BhiZg9XhGfNhFG2YgJPWmCqXe0Jc29UbyXldX5/xoSdGoJ0QKHFDODmS0ydBUWI5t2HMWaJOh6a7Djbg0UtxphjXPCmMwDSDJzb6dBQ9AndCLi8FkaEMgGaqKw1E6jpKhWuukyD6QSCwZqpKxWCwllJ7GrSY9zZ3ocCYIhaSnFWCNyl9Mma8pq+lpgyEkPa3KHwadniZRGvCluyhTxIJRFyN5xpzrloGQ5oOB+FJ02g8G0Ib2gwFVrpJ1StoHA6pQg4WFhfX0CQclWVjQcEoUUKZYLIUxQSquTzhMJj4hShCFPlj67D7hIFEaXkKZIv9HNSzCRzW+b0wmqIc1rjm18dhHTvKo/z8f1aiidLRI+5kT83/lk4h8fp85qaJ0vIH+Pu8Pz/4H60e5L4KbXeoAAAAASUVORK5CYII="
        width="40px" class="img-logo">
    <ul id="gear-toolbar-buttons">
        <li><a class="gear-button" href="javascript:void(0);" onclick="gearSelectCode()">Select</a></li>
        <li><a class="gear-button" href="javascript:void(0);" onclick="gearCopyCode()">Copy</a></li>
    </ul>
</div>

<pre id="gear-precode"><code id="gear-code-container"><?php echo trim( $vars ); ?></code></pre>

<div id="gear-debug-backtrace">
    <div id="gear-debug-backtrace-heading">
        <h1>Debug Backtrace</h1>

        <ul id="gear-debug-backtrace-heading-info">
            <li><span>Duration <span><?php echo $metric->getDuration(); ?></span></span></li>
            <li><span>Memory Usage <span><?php echo $metric->getPeakMemory(); ?></span></span></li>
    </div>

    <div class="clear-both"></div>

    <ol id="gear-debug-backtrace-chronology">
        <?php foreach ( $trace->chronology() as $chronology ): ?>
            <li>
                <strong><?php echo $chronology->call; ?></strong><br>
                <i><?php echo $chronology->file; ?>:<?php echo $chronology->line; ?></i>
            </li>
        <?php endforeach; ?>
    </ol>
</div>

<script type="text/javascript">
    <?php echo file_get_contents( __DIR__ . '/assets/js/print-out.js' ) ?>
</script>

</body>
</html>