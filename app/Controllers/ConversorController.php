<?php

namespace App\Controllers;

class ConversorController extends BaseController
{
    /** @var unidades */
    private $unidades = [
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    ];

    /** @var dezenas */
    private $dezenas = [
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10
    ];

    /** @var centenas */
    private $centenas = [
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
    ];

    /** @var milhares */
    private $milhares = [
        '¯IX' => 9000,
        '¯VIII' => 8000,
        '¯VII' => 7000,
        '¯VI' => 6000,
        '¯V' => 5000,
        '¯IV' => 4000,
        'M' => 1000,
    ];

    /** @var mapaAlgarismos */
    private $mapaAlgarismos = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    ];


    public $dados = [
        'valorArabico' => '',
        'valorRomano' => '',
        'resultadoArabico' => '',
        'resultadoRomano' => ''
    ];

    /**
     *  Renderiza o view
     * 
     * @return RendererInterface
     */
    public function index(): string
    {
        return view('index', $this->dados);
    }

    /**
     *  Realiza a conversão de algarismos romanos para arábicos e retorna para a página inicial
     * 
     * @return RedirectResponse
     */
    public function converterParaArabico(): string
    {
        $valor = strval($this->request->getGet('valorRomano'));

        $this->validarAlgarismosRomanos($valor);

        $algarismoArabico = 0;
        $i = 0;

        if (preg_match('/^[IVXLCDM]+$/u', $valor)) {
            while ($i < strlen($valor)) {
                if ($i + 1 < strlen($valor) && isset($map[$valor[$i] . $valor[$i + 1]])) {
                    $algarismoArabico += $map[$valor[$i] . $valor[$i + 1]];
                    $i += 2;
                } else {
                    $algarismoArabico += $this->mapaAlgarismos[$valor[$i]];
                    $i++;
                }
            }
        }

        $this->dados['resultadoArabico'] = $algarismoArabico;
        $this->dados['valorRomano'] = $valor;
        return view('index', $this->dados);
    }

    /**
     *  Realiza a conversão de algarismos arábicos para romanos e retorna para a página inicial
     * 
     * @return RedirectResponse
     */
    public function converterParaRomano(): string
    {
        $valor = strval($this->request->getGet('valorArabico'));

        $this->validarAlgarismosArabicos($valor);

        $valor = str_pad($valor, 4, '0', STR_PAD_LEFT);
        $digitos = str_split($valor);

        $dados = [
            'milhar' => intval($digitos[0] . '000'),
            'centena' => intval($digitos[1] . '00'),
            'dezena' => intval($digitos[2] . '0'),
            'unidade' => intval($digitos[3]),
        ];

        $algarismoRomano = '';

        foreach ($this->milhares as $romano => $arabico) {
            while ($dados['milhar'] >= $arabico) {
                $algarismoRomano .= $romano;
                $dados['milhar'] -= $arabico;
            }
        }

        foreach ($this->centenas as $romano => $arabico) {
            while ($dados['centena'] >= $arabico) {
                $algarismoRomano .= $romano;
                $dados['centena'] -= $arabico;
            }
        }

        foreach ($this->dezenas as $romano => $arabico) {
            while ($dados['dezena'] >= $arabico) {
                $algarismoRomano .= $romano;
                $dados['dezena'] -= $arabico;
            }
        }

        foreach ($this->unidades as $romano => $arabico) {
            while ($dados['unidade'] >= $arabico) {
                $algarismoRomano .= $romano;
                $dados['unidade'] -= $arabico;
            }
        }

        $this->dados['resultadoRomano'] = $algarismoRomano;
        $this->dados['valorArabico'] = $valor;
        return view('index', $this->dados);
    }

    private function validarAlgarismosArabicos($string)
    {
        if (!preg_match('/^[0-9]+$/', $string)) {
            return redirect()->back()->with('warning', 'Informe um algarismo válido');
        }
    }

    function validarAlgarismosRomanos($string)
    {
        if (!preg_match('/^[IVXLCDM]+$/u', $string)) {
            return redirect()->back()->with('warning', 'Informe um algarismo válido');
        }
    }
}
