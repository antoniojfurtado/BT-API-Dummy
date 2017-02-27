<?php

require('fpdf/fpdf.php');

class PrintLabels
{

    private $top_margin;
    private $side_margin;
    private $vertical_pitch;
    private $horizontal_pitch;
    private $label_height;
    private $label_width;
    private $labels_across;
    private $labels_along;
    private $labels;

    /**
     * @return mixed
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @param mixed $labels
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;
    }


    /**
     * @return mixed
     */
    public function getTopMargin()
    {
        return $this->top_margin;
    }

    /**
     * @param mixed $top_margin
     */
    public function setTopMargin($top_margin)
    {
        $this->top_margin = $top_margin;
    }

    /**
     * @return mixed
     */
    public function getSideMargin()
    {
        return $this->side_margin;
    }

    /**
     * @param mixed $side_margin
     */
    public function setSideMargin($side_margin)
    {
        $this->side_margin = $side_margin;
    }

    /**
     * @return mixed
     */
    public function getVerticalPitch()
    {
        return $this->vertical_pitch;
    }

    /**
     * @param mixed $vertical_pitch
     */
    public function setVerticalPitch($vertical_pitch)
    {
        $this->vertical_pitch = $vertical_pitch;
    }

    /**
     * @return mixed
     */
    public function getHorizontalPitch()
    {
        return $this->horizontal_pitch;
    }

    /**
     * @param mixed $horizontal_pitch
     */
    public function setHorizontalPitch($horizontal_pitch)
    {
        $this->horizontal_pitch = $horizontal_pitch;
    }

    /**
     * @return mixed
     */
    public function getLabelHeight()
    {
        return $this->label_height;
    }

    /**
     * @param mixed $label_height
     */
    public function setLabelHeight($label_height)
    {
        $this->label_height = $label_height;
    }

    /**
     * @return mixed
     */
    public function getLabelWidth()
    {
        return $this->label_width;
    }

    /**
     * @param mixed $label_width
     */
    public function setLabelWidth($label_width)
    {
        $this->label_width = $label_width;
    }

    /**
     * @return mixed
     */
    public function getLabelsAcross()
    {
        return $this->labels_across;
    }

    /**
     * @param mixed $labels_across
     */
    public function setLabelsAcross($labels_across)
    {
        $this->labels_across = $labels_across;
    }

    /**
     * @return mixed
     */
    public function getLabelsAlong()
    {
        return $this->labels_along;
    }

    /**
     * @param mixed $labels_along
     */
    public function setLabelsAlong($labels_along)
    {
        $this->labels_along = $labels_along;
    }



    function AddLabelsToPdf() {

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->SetMargins(0, 0);
        $pdf->SetAutoPageBreak(false);
        $x = $y =  $x_across = $y_across = 0;

        foreach($this->labels as $label) {

            $x = $this->side_margin + ($this->horizontal_pitch * $x_across);
            $y = $this->top_margin + ($this->vertical_pitch * $y_across);
            $pdf->SetXY($x, $y);
            $pdf->MultiCell($this->label_width, $this->label_height, $label, 1, 'C');


            $y_across++; // next row
            if($y_across == $this->labels_along) { // end of page wrap to next column
                $x_across++;
                $y_across = 0;
                if($x_across == $this->labels_across) { // end of page
                    $x_across = 0;
                    $y_across = 0;
                    $pdf->AddPage();
                }
            }
        }
        $pdf->Output('Labels.pdf', 'D');
    }
}