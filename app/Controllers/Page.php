<?php

namespace App\Controllers;

use App\Models\PageModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Picqer\Barcode\BarcodeGeneratorHTML;

class Page extends BaseController
{
    protected $produk;
    protected $barcode;
    protected $pdf;

    public function __construct()
    {
        $this->produk = new PageModel();
        $this->barcode = new BarcodeGeneratorHTML();
        $this->pdf = new Dompdf();
    }

    public function index()
    {
        $data = [
            'produk' => $this->produk->getProduk()
        ];

        return view('Page/index', $data);
    }

    public function data()
    {
        $data = [
            'produk' => $this->produk->getProduk()
        ];

        return view('Page/dataProduk', $data);
    }

    public function tambah()
    {
        $data = [
            'kode' => $this->request->getVar('kode'),
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
        ];

        $this->produk->insert($data);

        return redirect()->to('page');
    }

    public function import()
    {
        $file_excel = $this->request->getFile('file');
        $ext = $file_excel->getClientExtension();

        if ($ext == 'xls') {
            $render = new Xls();
        } else {
            $render = new Xlsx();
        }

        $spreadsheet = $render->load($file_excel);

        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }

            $kode = $row[0];
            $nama = $row[1];
            $harga = $row[2];

            $simpanData = [
                'kode' => $kode,
                'nama' => $nama,
                'harga' => $harga
            ];

            $this->produk->insert($simpanData);
        }
        return redirect()->to('page');
    }

    public function delete($id)
    {
        $this->produk->delete($id);
        return redirect()->to('page');
    }

    public function exportData()
    {
        $data = [
            'produk' => $this->produk->getProduk()
        ];

        $this->pdf->loadHtml(view('page/dataProduk', $data));
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("data-produk");

        return redirect()->to('page');
    }
}
