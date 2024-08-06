<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Conversor de algarismo</title>
    <meta name="description" content="Conversor rápido de algarismos">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>

    <div class="container mt-4 p-4">
        <!-- HEADER: MENU + HEROE SECTION -->
        <header>
            <div>
                <h1 class="text-center">Conversor de algarismos</h1>
            </div>
        </header>

        <!-- CONTENT -->
        <div class="mt-4">
            <p class="text-center">Selecione a conversão que deseja realizar</p>

            <?php if (session()->has('warning')) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo session('warning'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div>

                <form class="form-inline m-2 p-2" action="/romano-para-arabico">
                    <label for="romano">Algarismo Romano:</label>
                    <input type="text" class="form-control m-2" placeholder="Insira um algarismo romano" id="romano" name="valorRomano" value="<?php echo old('valorRomano', $valorRomano) ?>" >
                    <label for="arabico">Algarismo Arábico:</label>
                    <input type="text" class="form-control m-2" placeholder="Resultado" name="resultadoArabico" id="arabico" value="<?php echo old('resultadoArabico', $resultadoArabico) ?>"readonly>
                    <button type="submit" class="btn btn-primary">Converter</button>
                </form>
            </div>

            <div>
                <form class="form-inline m-2 p-2" action="/arabico-para-romano">
                    <label for="arabico">Algarismo Arábico:</label>
                    <input type="text" class="form-control m-2" placeholder="Insira um algarismo arábico" id="arabico" name="valorArabico" value="<?php echo old('valorArabico', $valorArabico) ?>">
                    <label for="romano">Algarismo Romano:</label>
                    <input type="text" class="form-control m-2" placeholder="Resultado" name="resultadoRomano" id="romano" value="<?php echo old('resultadoRomano', $resultadoRomano) ?>" readonly>
                    <button type="submit" class="btn btn-primary">Converter</button>
                </form>
            </div>


        </div>

    </div>
</body>

</html>