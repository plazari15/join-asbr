<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compre Já</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin:30px 0">
                <div class="col-lg-3">
                    <img src="img/logo.png" class="img-thumbnail">
                </div>
                <div class="col-lg-9">
                    <h3>Nome do Produto</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6" id="form-container">

                    <form id="step_1" class="form-step">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Preencha seus dados para receber contato
                                </div>
                            </div>
                            <div class="panel-body">
                                <fieldset>
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Nome Completo</label>
                                            <input class="form-control" type="text" name="nome" required>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Data de Nascimento</label>
                                            <input class="form-control" type="text" name="data_nascimento" required>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" required>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Telefone</label>
                                            <input class="form-control" type="text" name="telefone" required>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-lg btn-info next-step">Próximo Passo</button>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>

                    <form id="step_2" class="form-step" style="display:none">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Preencha seus dados para receber contato
                                </div>
                            </div>
                            <div class="panel-body">
                                <fieldset>
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Região</label>
                                            <select class="form-control regiao" name="regiao" required>
                                                <option value="">Selecione a sua região</option>
                                                <option value="1">Sul</option>
                                                <option value="2">Sudeste</option>
                                                <option value="3">Centro-Oeste</option>
                                                <option value="4">Nordeste</option>
                                                <option value="5">Norte</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Unidade</label>
                                            <select class="form-control" name="unidade" id="units" required>
                                                <option value="">Selecione a unidade mais próxima</option>
                                                <option>???</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-lg btn-info next-step" id="final_step">Enviar</button>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>

                    <div id="step_sucesso" class="form-step" style="display:none">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Obrigado pelo cadastro!
                                </div>
                            </div>
                            <div class="panel-body">
                                Em breve você receberá uma ligação com mais informações!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h1>Chamada interessante para o produto</h1>
                    <h2>Mais uma informação relevante</h2>
                </div>
            </div>
        </div>
        <script>
            $(function () {
                //Pronto
                $('.next-step').click(function (event) {
                    event.preventDefault();
                    $(this).parents('.form-step').hide().next().show();
                });

                //Este código se responsabiliza por enviar o form
                $('#final_step').click(function (event) {
                    event.preventDefault();
                    var form = $('#step_1,#step_2').serialize();

                    $.ajax({
                        url: '/api/send',
                        data: form,
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function(){
                            alert('saiu');
                        },
                        success: function(){
                            //
                        }

                    });
                });

                //Este código obtem as unidades
                $('.regiao').change(function () {
                    var regiao = $(this).serialize();
                    $.ajax({
                        url: '/api/getRegion',
                        data: regiao,
                        type: 'GET',
                        dataType: 'JSON',
                        beforeSend: function(){
                            //
                        },
                        success: function(RESPOSTA){
                            console.log(RESPOSTA);
                            $('#units option[value!=""]').remove();
                            $.each(RESPOSTA.body, function(key, value) {
                                $('#units').append('<option value="' + value.id + '">' + value.title + '</option>');
                            });
                        }

                    });
                });
            });
        </script>
    </body>
</html>
