<?php

namespace App\Http\Controllers;

use App\Models\Town;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $dropdown_keberangkatan = $this->dropdown('Keberangkatan', 'kota_berangkat');
        $dropdown_tujuan = $this->dropdown('Tujuan', 'kota_tujuan');
        return view('welcome', [
            'kota_berangkat' => $dropdown_keberangkatan,
            'kota_tujuan' => $dropdown_tujuan
        ]);
    }

    public function dropdown($label, $name)
    {
        $html = '<select name="' . $name . '" class="form-select" aria-label="' . $label . '">';
        $result = Town::all();
        $html .= '<option value="">== Pilih Kota ' . $label . ' ==</option>';
        foreach ($result as $key => $val) {
            $html .= '<option value="' . $val->id . '">' . $val->nama . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
}
