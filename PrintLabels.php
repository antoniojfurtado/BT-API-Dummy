<?php

require('fpdf/fpdf.php');
class PrintLabels
{
    const UNIT_MM = 'mm';
    const UNIT_PERCENT = '%';
    private $padding_vertical;
    private $padding_horizontal;
    private $padding_vertical_mid;
    private $padding_horizontal_mid;
    private $padding_unit;

    /**
     * @return mixed
     */
    public function getPaddingVertical()
    {
        return $this->padding_vertical;
    }

    /**
     * @param mixed $padding_vertical
     */
    public function setPaddingVertical($padding_vertical)
    {
        $this->padding_vertical = $padding_vertical;
    }

    /**
     * @return mixed
     */
    public function getPaddingHorizontal()
    {
        return $this->padding_horizontal;
    }

    /**
     * @param mixed $padding_horizontal
     */
    public function setPaddingHorizontal($padding_horizontal)
    {
        $this->padding_horizontal = $padding_horizontal;
    }

    /**
     * @return mixed
     */
    public function getPaddingVerticalMid()
    {
        return $this->padding_vertical_mid;
    }

    /**
     * @param mixed $padding_vertical_mid
     */
    public function setPaddingVerticalMid($padding_vertical_mid)
    {
        $this->padding_vertical_mid = $padding_vertical_mid;
    }

    /**
     * @return mixed
     */
    public function getPaddingHorizontalMid()
    {
        return $this->padding_horizontal_mid;
    }

    /**
     * @param mixed $padding_horizontal_mid
     */
    public function setPaddingHorizontalMid($padding_horizontal_mid)
    {
        $this->padding_horizontal_mid = $padding_horizontal_mid;
    }

    /**
     * @return mixed
     */
    public function getPaddingUnit()
    {
        return $this->padding_unit;
    }

    /**
     * @param mixed $padding_unit
     */
    public function setPaddingUnit($padding_unit)
    {
        $this->padding_unit = $padding_unit;
    }





}