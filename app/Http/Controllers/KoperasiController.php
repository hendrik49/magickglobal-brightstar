<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoperasiController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.index');
    }

    public function anggotaIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.anggota.index'); // Tampilkan daftar anggota
    }

    public function simpananIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.simpanan.index');
    }

    public function pinjamanIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.pinjaman.index');
    }

    public function pemasukanIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.pemasukan.index');
    }

    public function pengeluaranIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.pengeluaran.index');
    }

    public function tabunganIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.tabungan.index');
    }

    public function halamanAnggotaIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.halaman_anggota.index');
    }

    public function parameterIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.parameter.index');
    }

    public function kolektabilitasIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.kolektabilitas.index');
    }

    public function shuIndex()
    {
        if (!Auth::user()->can('manage koperasi')) {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

        return view('koperasi.shu.index');
    }

}
