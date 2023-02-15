<style>
    body {
        background: white;
    }

    #div1 {
        min-height: 100vh;
    }

    @media (max-width:766px) {
        #div1 {
            min-height: auto;
        }
    }
</style>


<div class="row">

    <div id="div1" class="col-md-3" style=" background: rgb(27, 15, 51); background: linear-gradient(90deg, rgba(27, 15, 51, 1) 0%, rgba(68, 42, 122, 1) 40%); ">
        <img src="../imagenes/saldosicoblanco.png" alt="" style="display: block; margin:auto; margin-top:20px; width:100px">
        <h2 style="color: white;font-weight: 900; text-align:center; margin-top:20px; font-family:sources">ALTA A COLABORADOR</h2>
        <h5 style="color: white;font-weight: 400; text-align:center; font-size:30px; font-family:sources"><?php echo $_SESSION['razonsocial'] ?></h5>
    </div>


    <div class="col-md-9 row">

        <!-- <div class="col-md-5 p-5"> ROW
            <h2 style="color:#442a7a">INGRESAR DATOS</h2>
            <p style="color:black">Elige la opción que se adapte a tus necesidades, para comenzar toma en cuenta que debes de tener a la mano algúno de estos archivos o documentos:</p>
            <br>
            <p style="color:black"> <span style="font-weight:bold ;">Impresión </span>de constancia de situación fiscal de cada colaborador</p>
            <p style="color:black"> <span style="font-weight:bold ;">Archivo/s pdf comprimidos en .ZIP </span>del listado o archivo concentrador de las constancias de situación fiscal.</p>

            <img src="../imagenes/constancia.png" alt="constancia" width="100%">

        </div> -->
        <div class="col-md-6 p-5 ">

            <img src="../imagenes/ico_qr.png" alt="qr" style="display:block; margin:auto; width:75px; margin-top:50px">
            <a name="" id="" class="btn btn-primary" href="../gui/qr2.php" role="button" style="display:block; margin:auto; width:50%; margin-top:10px; margin-bottom:10px; background-color:#442a7a; border-color:#442a7a">CAPTURAR CODIGOS QR</a>
            <p style="text-align:center; color:black;">Al elegir esta opción deberás <span style="font-weight:bold">tener a la mano una imagen del código QR</span> puede ser impresa o bien una imagen en formato digital.</p>
        </div>

        <div class="col-md-6 p-5 ">

            <img src="../imagenes/ico_pdf.png" alt="qr" style="display:block; margin:auto; width:70px; margin-top:50px">
            <a name="" id="" class="btn btn-primary" href="../gui/gui_subir_archivo.php" role="button" style="display:block; margin:auto; width:50%; margin-top:10px; margin-bottom:10px; background-color:aqua; border-color:aqua">SUBE ARCHIVO ZIP o PDF</a>
            <p style="text-align:center; color:black;">Puedes subir archivos directamente en fomrato .PDF, en caso de querer subir  varios archivos al mismo tiempo deberá de ser en .ZIP: <br> Al elegir esta opción asegurate de tener un archivo .ZIP que concentre en una o varias constancias de situación fiscal, recuerda que <span style="font-weight:bold">debe ser el archivo.pdf que proporciona el SAT,</span> el archivo
                <span style="font-weight:bold"> deberá de estar comprimido en formato .ZIP</span>
                <br>
                <span style="color:gray; font-weight:bold; font-size:15px">(1 archivo .ZIP puede tener dentro varias constancias .PDF)</span>
            </p>
            <!-- <p style="color:gray; font-size:15px; text-align:center">
                *El archivo debe de estar en formato ZIP. Evita archivos con extensiones .RAR p .PDF Directo, si tienes dudas al momento de comenzar el uso de esta plataforma comunicate con nosotros.
            </p> -->

        </div>


    </div>

</div>