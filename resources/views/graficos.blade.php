@extends('layouts.layout')

@section('content')
    <script src="{{ Vite::asset("resources/js/plotly-2.32.0.min.js") }}"></script>

    <div class="p-4 flex-1 flex flex-col gap-2 justify-center">
        <div class="relative p-2 flex-1 flex flex-col gap-2 border border-solid border-gray-600/40 rounded-lg">
            <h3 class="text-xl"><span class="font-bold">Faturamento Total:</span> R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h3>

            <div id="lanchesFaturamento">

            </div>

            <script>
                let dataFaturamento = [{
                    values: [
                        @foreach ($dados["faturamento"] as $index => $faturamentoLanche)
                            {{ $faturamentoLanche["total"] }}
                            @if($index + 1 < count($dados["faturamento"]))
                                {{ "," }}
                            @endif
                        @endforeach
                    ],
                    labels: [
                        @foreach ($dados["faturamento"] as $index => $faturamentoLanche)
                            <?php echo("'"); ?>{{ $faturamentoLanche["lanche"]->name }}<?php echo("'"); ?>
                            @if($index + 1 < count($dados["faturamento"]))
                                {{ "," }}
                            @endif
                        @endforeach
                    ],
                    type: "pie"
                }];

                let layoutFaturamento = {
                    title: "Participação de cada Lanche no Faturamento",
                    font: { size: 20 }
                };

                let configFaturamento = {
                    responsive: true
                }

                Plotly.newPlot("lanchesFaturamento", dataFaturamento, layoutFaturamento, configFaturamento);
            </script>
        </div>

        <div class="relative p-2 flex-1 flex flex-col gap-2 border border-solid border-gray-600/40 rounded-lg">
            <h3 class="text-xl"><span class="font-bold">Vendas Totais:</span> {{ $vendasTotal }}</h3>

            <div id="lanchesVendas"></div>

            <script>
                let dataVendas = [{
                    values: [
                        @foreach ($dados["vendasLanche"] as $index => $vendas)
                            {{ $vendas["total"] }}
                            @if($index + 1 < count($dados["vendasLanche"]))
                                {{ "," }}
                            @endif
                        @endforeach
                    ],
                    labels: [
                        @foreach ($dados["vendasLanche"] as $index => $vendas)
                            <?php echo("'"); ?>{{ $vendas["lanche"]->name }}<?php echo("'"); ?>
                            @if($index + 1 < count($dados["vendasLanche"]))
                                {{ "," }}
                            @endif
                        @endforeach
                    ],
                    type: "pie"
                }];

                let layoutVendas = {
                    title: "Participação de cada Lanche nas Vendas",
                    font: { size: 20 }
                };

                let configVendas = {
                    responsive: true
                }

                Plotly.newPlot("lanchesVendas", dataVendas, layoutVendas, configVendas);
            </script>
        </div>
    </div>
@endsection
