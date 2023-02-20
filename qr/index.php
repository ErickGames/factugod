<?php

include_once("../config/global_config_includes.php");

?>

<!--<script src="./node_modules/html5-qrcode/html5-qrcode.min.js"></script>-->
<script src="https://unpkg.com/html5-qrcode"></script>

<div class="container text-center">
    <div class="row g-5">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div id="reader"></div>
            <input type="file" class="form-control" id="qr-input-file" accept="image/*">
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>
<script type="text/javascript">
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        alert('Code matched = ' + decodedText + ', ' + decodedResult);
        //console.log(`Code matched = ${decodedText}`, decodedResult);
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        //console.warn(`Code scan error = ${error}`);
    }


    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        /* verbose= */
        false);


    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

    // This method will trigger user permissions
    Html5Qrcode.getCameras().then(devices => {
        /**
         * devices would be an array of objects of type:
         * { id: "id", label: "label" }
         */
        if (devices && devices.length) {
            var cameraId = devices[0].id;
            // .. use this to start scanning.
            const html5QrCode = new Html5Qrcode( /* element id */ "reader");
            html5QrCode.start(
                    cameraId, {
                        fps: 10, // Optional, frame per seconds for qr code scanning
                        qrbox: {
                            width: 250,
                            height: 250
                        }, // Optional, if you want bounded box UI
                        facingMode: "environment"
                    },
                    (decodedText, decodedResult) => {
                        // do something when code is read
                        //alert('codigo leido Code matched = ' + decodedText + ', ' + decodedResult);

                        html5QrCode.stop().then((ignore) => {
                            // QR Code scanning is stopped.
                        }).catch((err) => {
                            // Stop failed, handle it.
                        });

                        $.ajax({
                            url: '../ajax/alta_escanear_sat.php',
                            dataType: "text",
                            data: {
                                'liga': decodedText
                            },
                            type: 'post',
                            beforeSend: function() {
                                //$("#loading_dipetre").show();
                            },
                            success: function(data) {
                                alert(data);
                                location.reload();
                                //location.href("../gui/index.php");
                            },
                            complete: function(data) {
                                //$("#loading_dipetre").hide();
                            }
                        });

                    },
                    (errorMessage) => {
                        // parse error, ignore it.
                    })
                .catch((err) => {
                    // Start failed, handle it.
                });
        }
    }).catch(err => {
        // handle err
    });

    const fileinput = document.getElementById('qr-input-file');
    fileinput.addEventListener('change', e => {
        if (e.target.files.length == 0) {
            // No file selected, ignore 
            return;
        }

        const imageFile = e.target.files[0];
        // Scan QR Code
        const html5QrCode = new Html5Qrcode( /* element id */ "reader");
        html5QrCode.scanFile(imageFile, true)
            .then(decodedText => {
                // success, use decodedText
                console.log(decodedText);
            })
            .catch(err => {
                // failure, handle it.
                console.log(`Error scanning file. Reason: ${err}`);
            });
    });
</script>