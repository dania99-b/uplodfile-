
<style>


    .button-set {
        background-color: white;
        margin: 0 auto;
        width: 40%;
    }
    .button-set h4 {
        font-size: 25px;
        color: #2f8ecc;
    }

    .upload-drag-and-drop-box {
        min-height: 150px;
        border: 3px dashed grey;
        text-align: center;
        padding: 50px 0px 10px 0px;
    }
    .upload-drag-and-drop-box:hover {
        min-height: 150px;
        border: 3px solid grey;
        text-align: center;
        background: rgba(68, 177, 250, 0.08);;
        padding: 50px 0px 10px 0px;
    }

    .file-type-desc {
        font-size: 18px;
        color: black;
        margin-top: 10px;
        padding-bottom: 5px;
    }
    .drag-drop-text {
        font-size: 20px;
        display: inline-block;
        color: #8c99a5;
        font-weight: normal;
    }
    .browse-button {
        font-size: 17px;
        padding: 1px;
        line-height: normal;
        box-shadow: none;
        background-color: grey;
        color: #F9FAFA;
        padding: 7px 15px 7px 15px;
        margin-left: 3px;
        border-radius: 5px;
        display: inline;
        text-decoration: underline;
        font-weight: normal;
    }

    .file-upload-buttons {
        margin: 0 auto;
        width: 50%;
        text-align: center;
    }
    .form-back-button {
        background: #8d999f;
        padding: 10px 40px 0px 40px;
        margin-right: 25px;
        color: white;
        border: none;
        border-radius: 7px;
        font-size: 20px;
        -webkit-box-shadow: 2px 2px 7px 0px rgba(50, 50, 50, 0.55);
        -moz-box-shadow: 2px 2px 7px 0px rgba(50, 50, 50, 0.55);
        box-shadow: 2px 2px 7px 0px rgba(50, 50, 50, 0.55);
    }
    .form-back-button img {
        margin-right: 10px;
        position: relative;
    }
    .form-back-button:hover {
        -webkit-box-shadow: 1px 1px 7px 0px rgba(50, 50, 50, 0.55);
        -moz-box-shadow: 1px 1px 7px 0px rgba(50, 50, 50, 0.55);
        box-shadow: 1px 1px 7px 0px rgba(50, 50, 50, 0.55);
    }
    .form-back-button img:hover {
        right: 2px;
    }
    .form-upload-button {
        background: #44B1FA;
        padding: 10px 40px 0px 40px;
        min-height: 55px;
        color: white;
        border: none;
        border-radius: 7px;
        font-size: 20px;
        -webkit-box-shadow: 2px 2px 7px 0px rgba(50, 50, 50, 0.55);
        -moz-box-shadow: 2px 2px 7px 0px rgba(50, 50, 50, 0.55);
        box-shadow: 2px 2px 7px 0px rgba(50, 50, 50, 0.55);
    }

    .form-upload-button img {
        margin-left: 5px;
        position: relative;
    }
    .form-upload-button:hover {
        -webkit-box-shadow: 1px 1px 7px 0px rgba(50, 50, 50, 0.55);
        -moz-box-shadow: 1px 1px 7px 0px rgba(50, 50, 50, 0.55);
        box-shadow: 1px 1px 7px 0px rgba(50, 50, 50, 0.55);
    }
    .form-upload-button img:hover {
        top: -2px
    }
    .about-template {

    }
    .template-prep-tips {

    }
    .about-template-tips {
        background-color: white;
        padding: 20px 15px 30px 25px;
        margin: 0 auto;
        margin-bottom: 40px;
        width: 80%;
        border: 2px solid #2f8ecc;
        border-radius: 5px;
        font-size: 15px;
        overflow: hidden;
    }
    .ajax-file-upload-statusbar {
        border: 1px solid rgba(184,187,187,1);
        margin-right: 14px;
        margin: 25px 0px 0px 0px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        padding: 5px 5px 5px 5px;
        width: 21px;
        -webkit-box-shadow: 3px 3px 7px -1px rgba(184,187,187,1);
        -moz-box-shadow: 3px 3px 7px -1px rgba(184,187,187,1);
        box-shadow: 3px 3px 7px -1px rgba(184,187,187,1);
    }
    .ajax-file-upload-progress {
        margin: 0 10px 5px 10px;
        min-height: 31px;
        position: relative;
        width: 78%;
        border: 1px solid #ddd;
        padding: 2px;
        border-radius: 3px;
        display: inline-block;
    }
    .ajax-file-upload-bar {
        background-color: #0ba1b5;
        width: 0;
        height: 25px;
        font-size: 17px;
        border-radius: 3px;
        color: #FFFFFF;
    }
</style>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!--{GLOBAL_MESSAGES_aae3749ba9c2e308ffa9c240ac185959}-->
            <!--/{GLOBAL_MESSAGES_aae3749ba9c2e308ffa9c240ac185959}-->

            <script type="text/javascript" src="/js/sinaprinting/jquery.uploadfile.min.js"></script>

            <form method="POST"  id="filename" action="{{ url('/storee') }}" enctype="multipart/form-data">
              @csrf
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file"  name="filename" value="filename" placeholder="Choose file" id="filename" >
                            @error('file')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </div>
            </form>


    </div>
    </form>
    <div class="about-template-tips">
        <div class="fieldset about-template">
            <h4 class="legend">
                PDF template references:
            </h4>
            <p>
                You can download the PDF template below and follow the specifications inside
            </p>
            <ol style="list-style-type: initial; margin-left: 20px;">
                <li style="padding: 5px;">
                    <a href="/media/guides/pdf/4_x_6.pdf" title="4&quot; x 6&quot;" target="_blank">
                        4" x 6"
                    </a>
                </li>
            </ol>
        </div>
        <div class="fieldset template-prep-tips">
            <h4 class="legend">
                Artwork Preparation Tips
            </h4>
            <ol style="list-style-type: decimal; margin-left: 20px;">
                <li>
                    Download our guides/templates to ensure a more optimal print result.
                </li>
                <li>
                    Files must be submitted with proper orientation to ensure proper back up.
                </li>
                <li>
                    It is best to try to avoid using borders in your design. If a border is too close to the trim, the trim may be slightly off-center.
                </li>
                <li>
                    File must consist of 1/8" bleed and all important art and text must be within the safety margin.
                </li>
                <li>
                    Ensure that your PDF is high res and that all images are CMYK at 300 DPI.
                </li>
                <li>
                    Black type should have the following values: C0, M0, Y0, K100.
                </li>
                <li>
                    Embed or outline all fonts.
                </li>
                <li>
                    Ensure your artwork colour is in CMYK format
                </li>
            </ol>
        </div>
    </div>
</div>
</div>
</div>
