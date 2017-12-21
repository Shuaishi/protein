<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Corrsite</title>
    <script type="text/javascript" src="resource/js/jsmol/JSmol.min.js"></script>
    <!--<link href="resource/css/select.css" rel="stylesheet" type="text/css"/>-->
    <link href="resource/css/main.css" rel="stylesheet" type="text/css"/>
    <!--<link href="resource/css/mystyle.css" rel="stylesheet" type="text/css"/>-->
    <link href="resource/semancui/semantic.css" rel="stylesheet" type="text/css"/>
    <link href="resource/mystyle.css" rel="stylesheet" type="text/css">
    <link href="Semantic-UI-CSS-master/semantic.min.css" rel="stylesheet" type="text/css">

    <script src="resource/js/jquery/jquery.js"></script>
    <script src="Semantic-UI-CSS-master/semantic.min.js"></script>
    <script src="assets/library/iframe.js"></script>
    <script type="text/javascript" src="resource/FileSaver/FileSaver.js"></script>
    <script type="text/javascript" src="resource/js/jquery.ajaxfileupload.js"></script>
    <script type="text/javascript" src="myJSscript.js"></script>
    <?php $sessws = "user_sess/2017.12.20XuYoujun";
    session_start();
    $_SESSION['sessws'] = $sessws; ?>
    <!--<script type="text/javascript" src="resource/js/require.js"></script>-->


</head>
<body>


<div class="ui padded grid">
    <div class="nine wide column">

        <div class="ui compact segment">
         <div id="mol" ></div>

        </div>
    </div>


    <div class="seven wide column">
        <div >
            <div class="treemenu boxed">
                <div class="ui styled accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i>
                        <b>Cavity module</b>
                    </div>
                    <div class="active content">
                        <div class="ui action left icon input">
                            <select class="ui dropdown" onchange="selectInputType()" id="typeValue" name="inputType">
                                <option value="1">PDBEntry</option>
                                <option value="2">PDBFile</option>
                            </select>
                            <div class="ui teal button">InputType</div>
                        </div>
                        <div class="ui divider"></div>

                        <div class="ui input" id="entry">
                            <input class="ui mini input"  type="text" placeholder="please input PDB ID" id="proteinID"
                                   onkeyup="value=value.replace(/[\W]/g,'')"
                                   onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[\W]/g,''))"
                                   maxlength="4" name="proteinID">
                            <button class="ui mini icon button" onclick="loadPDB()" type="button"><i class="search icon"></i></button>
                        </div>

                        <div class="ui mini input" id="file" style="display: none">
                            <form method="post" action="" enctype="multipart/form-data">
                                <label>
                                    <div class="ui mini icon button"> Protein input</div>
                                    <input type="file" name="file" id="proteinFile" /></label>
                            </form>
                        </div>
                        <div class="ui divider"></div>
                        <form method="post" action="cavity.php" enctype="multipart/form-data">
                            <div class="ui input">
                                <div id="content"></div>
                                <a class="ui label" id="selectchains"
                                   style="text-align: center">Show chain(s)</a>
                            </div>

                            <div class="ui divider"></div>
                            <div class="ui input" id="mode">
                                <div class="ui text">
                                    <div>
                                        <span style="width: 80px;"><strong>Mode</strong></span>
                                        <span class="help-tip">
                                 <p>This is an inline tip!</p>
                                </span>
                                        <input value="0" id="cmode-1" type="radio" name="cmode" checked="checked"
                                               onclick="selectCavityMode()"/>
                                        <label for="cmode-1">No Ligand</label>
                                        <input value="1" id="cmode-2" type="radio" name="cmode"
                                               onclick="selectCavityMode()">
                                        <label for="cmode-2">With Ligand</label>

                                    </div>
                                </div>

                            </div>
                            <div class="ui divider"> </div>

                            <div class="ui mini input" id="Cligfile" style="display: none">

                                <label>
                                    <div class="ui mini icon button">Ligand input</div>
                                    <input type="file" name="ligfile" id="ligandFile" />
                                </label>
                            </div>



                            <div class="accordion">
                                <div class="title">
                                    <i class="dropdown icon"></i> Advanced parameters
                                    <span class="help-tip"><p>This is an inline tip!</p>
                                </span>
                                </div>
                                <div class="content">
                                    <div class="ui labeled input">
                                        <div class="ui label"
                                             style="font-size: 12px;color: black;background-color: whitesmoke;width: 180px;">
                                            SEPARATE_MIN_DEPTH
                                            <span class="help-tip"><p>This is an inline tip!</p></span></div>
                                        <input id="SMD" name="SMD" value="8" type="text" class="active" size="4"
                                               style="text-align: right;">
                                        <div class="ui basic label" style="border: none;">Å</div>
                                    </div>

                                    <div class="ui labeled input">
                                        <div class="ui label"
                                             style="font-size: 12px;color: black;background-color: whitesmoke;width: 180px;">
                                            MAX_ABSTRACT_LIMIT
                                            <span class="help-tip"><p>This is an inline tip!</p></span></div>
                                        <input id="MAL" name="MAL" value="1500" type="text" class="active" size="4"
                                               style="text-align: right;">
                                        <div class="ui basic label" style="border: none;">Å<sup>2</sup></div>
                                    </div>


                                    <div class="ui labeled input">
                                        <div class="ui label"
                                             style="font-size: 12px;color: black;background-color: whitesmoke;width: 180px;">
                                            SEPARATE_MAX_LIMIT
                                            <span class="help-tip"><p>This is an inline tip!</p></span></div>
                                        <input id="SML" name="SML" value="6000" type="text" class="active" size="4"
                                               style="text-align: right;">
                                        <div class="ui basic label" style="border: none;">Å<sup>2</sup></div>
                                    </div>

                                    <div class="ui labeled input">
                                        <div class="ui label"
                                             style="font-size: 12px;color: black;background-color: whitesmoke;width: 180px;">
                                            MIN_ABSTRACT_DEPTH
                                            <span class="help-tip"><p>This is an inline tip!</p></span></div>
                                        <input id="MAD" name="MAD" value="2" type="text" class="active" size="4"
                                               style="text-align: right;">
                                        <div class="ui basic label" style="border: none;">Å</div>
                                    </div>
                                    <div class="ui labeled input">
                                        <div class="ui label"
                                             style="font-size: 12px;color: black;background-color: whitesmoke;width: 180px;">
                                            RULER_1
                                            <span class="help-tip"><p>This is an inline tip!</p></span></div>
                                        <input id="R1" name="R1" value="100" type="text" class="active" size="4"
                                               style="text-align: right;">
                                        <div class="ui basic label" style="border: none;">0.125 Å<sup>3</sup></div>
                                    </div>
                                    <div class="ui labeled input">
                                        <div class="ui label"
                                             style="font-size: 12px;color: black;background-color: whitesmoke;width: 180px;">
                                            OUTPUT_RANK
                                            <span class="help-tip"><p>This is an inline tip!</p></span></div>
                                        <input id="OR" name="OR" value="1.5" type="text" class="active" size="4"
                                               style="text-align: right;">
                                        <div class="basic label"></div>
                                    </div>

                    </div>
                </div>
                            <div class="ui hidden divider"></div>
                            <div style="text-align: center;">
                                <button class="ui teal button" type="submit" id="submitCavity">
                                    Submit
                                </button>
                            </div>
                        </form>

            </div>
            <div class="title">
                <i class="dropdown icon"></i> <b>Pocket module</b>
            </div>
            <div class="content">
                <div class="subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel euismod purus. Donec nec tempor lorem, et consequat tellus. Sed id consequat nibh. Praesent a posuere mi. Ut gravida feugiat diam, non accumsan risus facilisis et. Donec ullamcorper
                    facilisis magna a accumsan. Duis varius purus in dapibus interdum. Aenean a felis sit amet lectus interdum venenatis in imperdiet sapien. Sed at leo maximus, blandit orci ac, viverra orci.</div>
                <div class="accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i> Level 2A
                    </div>
                    <div class="active content">
                        <div class="subtitle">Level 2A Subtitles</div>

                    </div>
                </div>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> <b>CorrSite module</b>
            </div>
            <div class="content">

                <p>Orthosteric site*:</p>

                <div class="ui action left icon input">
                    <select class="ui dropdown" onchange="selectactiveInputType()" id="activeTypeValue"
                            name="inputType">
                        <option value="1">Cavity pockets</option>
                        <option value="2">Custom pockets</option>
                        <!--<option value="3">Cavity detection</option>-->
                    </select>
                    <div class="ui teal button">ActiveSiteType</div>
                </div>
                <div class="ui divider"></div>

                <div id="activeCavity">
                    <div style="text-align:center" id="CavityComputing">

                    </div>
                    <form id="myFormcavity">
                        <div id="Cavityoutput"></div>
                    </form>
                </div>


                <div class="ui input" id="activefile">
                    <form method="post" action="" enctype="multipart/form-data">
                        <label>
                            <div class="ui button"> Active site input</div>
                            <input type="file" name="file" id="activeProteinFile" style="width:80%"/></label>
                    </form>
                </div>

                <div class="ui input" id="activeRes" style="display: none">
                    <form method="post" action="" enctype="multipart/form-data">
                        <label>
                            <div class="ui button">Custom active residues</div>
                            <input type="file" name="file" id="activeSite" style="width:80%"/>
                        </label>
                    </form>
                </div>


                <div class="accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i> Parameters
                    </div>
                    <div class="active content">


                    </div>
                </div>
            </div>

            <div class="title">
                <i class="dropdown icon"></i> <b>CysPred module</b>
            </div>
            <div class="content">
                <div class="subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel euismod purus. Donec nec tempor lorem, et consequat tellus. Sed id consequat nibh. Praesent a posuere mi. Ut gravida feugiat diam, non accumsan risus facilisis et. Donec ullamcorper
                    facilisis magna a accumsan. Duis varius purus in dapibus interdum. Aenean a felis sit amet lectus interdum venenatis in imperdiet sapien. Sed at leo maximus, blandit orci ac, viverra orci.</div>
                <div class="accordion">
                    <div class="active title">
                        <i class="dropdown icon"></i> parameters
                    </div>
                    <div class="active content">


                        <div class="subtitle">Level 3A Subtitles</div>


                    </div>

                </div>
            </div>





        </div>
    </div>
    <div class="container">

    </div>




</div>
    </div>
</div>
<div class="container">

</div>



<div id="counter"></div>

<!--<div class="four wide column">-->
<!--<div class="ui violet segment" id="Corroutput" style="display: none">-->
<!--<p>Section3: Running Cavity or CorrSite...</p>-->
<!--<div style="text-align:center;">-->
<!--<img src="resource/image/Loading3.gif" style="width:100%;">-->
<!--</div>-->
<!--</div>-->

<!--<div class="ui violet segment" id="Corroutput1" style="display: none">-->
<!--<p>Section3: CorrSite output:</p>-->
<!--<form id="myFormout">-->
<!--<div id="outputCorr"></div>-->
<!--</form>-->
<!--<div class="ui divider"></div>-->

<!--<button class="ui violet basic button" onclick="downloadfile()">Download output</button>-->

<!--</div>-->
<!--</div>-->


</body>
</html>
