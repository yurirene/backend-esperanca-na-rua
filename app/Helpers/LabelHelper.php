<?php

namespace App\Helpers;

class LabelHelper
{
    public const ATIVO = 1;
    public const INATIVO = 0;
    public const DISPONIVEL = 1;
    public const INDISPONIVEL = 0;

    public const LABEL_ATIVO = "<span class='badge badge-pill badge-success pulse-success'>Ativo</span>";
    public const LABEL_INATIVO = "<span class='badge badge-pill badge-danger'>Inativo</span>";
    public const LABEL_DISPONIVEL = "<span class='badge badge-pill badge-danger pulse-success'>Disponivel</span>";
    public const LABEL_INDISPONIVEL = "<span class='badge badge-pill badge-danger'>Indisponivel</span>";

    public const LABEL_STATUS = [
        self::ATIVO => self::LABEL_ATIVO,
        self::INATIVO => self::LABEL_INATIVO,
    ];

    public const LABEL_DISPONIBILIDADE = [
        self::DISPONIVEL => self::LABEL_DISPONIVEL,
        self::INDISPONIVEL => self::LABEL_INDISPONIVEL
    ];

    /**
     * Função para retornar badge do bootstrap
     *
     * @param string $texto - Texto do Badge
     * @param string $cor - Cor
     * [primary, secondary, danger, success, warning, info]
     * @param boolean $pill - Cantos arrendondados
     * @return string
     */
    public static function badge(
        string $texto,
        string $cor,
        bool $pill = false
    ): string {
        return "<span class='badge "
        . ($pill ? 'badge-pill' : '')
        . " badge-" . $cor . "'>"
        . $texto . "</span>";
    }

}
