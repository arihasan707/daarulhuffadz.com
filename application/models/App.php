<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Model
{

    function get_where($table, $whare)
    {
        $this->db->from($table);
        $this->db->where($whare);
        return $this->db->get();
    }

    function get_detail_pmb_po($table, $where)
    {
        $this->db->from($table);
        $this->db->join('kelas_program_po', 'tbl_pmb_po.kelas=kelas_program_po.id');
        $this->db->where($where);
        return $this->db->get();
    }

    function lists()
    {
        $this->db->select('tbl_galeri.*');
        $this->db->from('tbl_galeri');
        $this->db->join('tbl_foto_galeri', 'tbl_foto_galeri.galeri_id = tbl_galeri.id', 'left');
        $this->db->group_by('tbl_galeri.id');
        $this->db->order_by('tbl_galeri.id', 'desc');
        return $this->db->get();
    }

    function news_join($where)
    {
        $this->db->from('tbl_news');
        $this->db->where($where);
        $this->db->join('tbl_admin', 'tbl_admin.id = tbl_news.user_id');
        return $this->db->get();
    }

    function join_program_diskon()
    {
        $this->db->from('tbl_program');
        $this->db->join('tbl_diskon', 'tbl_diskon.program_id = tbl_program.id', 'left');
        return $this->db->get();
    }

    function join_program_where_diskon($where)
    {
        $this->db->from('tbl_program');
        $this->db->where($where);
        $this->db->join('tbl_diskon', 'tbl_diskon.program_id = tbl_program.id', 'left');
        return $this->db->get();
    }

    function news($table)
    {
        $this->db->from($table);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit('4');
        return $this->db->get();
    }

    function get_where_notif_admin_2($table, $whare)
    {
        $this->db->from($table);
        $this->db->where($whare);
        $this->db->group_start();
        $this->db->or_where('prog', 'DH Institute S1 Double Gelar');
        $this->db->or_where('prog', 'SMP & SMA Tahfidz Boarding');
        $this->db->group_end();
        return $this->db->get();
    }

    function get_where_notif_admin_3($table, $whare)
    {
        $this->db->from($table);
        $this->db->where($whare);
        $this->db->group_start();
        $this->db->or_where('prog', 'Tahfidz Online');
        $this->db->group_end();
        return $this->db->get();
    }

    function get_notif_limit($table, $whare)
    {
        $this->db->from($table);
        $this->db->where($whare);
        $this->db->limit('5');
        return $this->db->get();
    }

    function get_pesan($table, $whare)
    {
        $this->db->from($table);
        $this->db->where($whare);
        $this->db->order_by('id', 'desc');
        return $this->db->get();
    }

    function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }

    function get_all($table)
    {
        $this->db->from($table);
        $this->db->order_by('id', 'DESC');
        return $this->db->get();
    }

    function all($table)
    {
        $this->db->from($table);
        return $this->db->get();
    }

    function get_pengurus()
    {
        $this->db->select('*');
        $this->db->from('tbl_karyawan');
        return $this->db->get();
    }

    function get_prov($table)
    {
        $this->db->from($table);
        return $this->db->get();
    }

    function get_kab($id)
    {
        return $this->db->get_where('regencies', ['province_id' => $id])->result();
    }

    function delete($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function update($table = null, $data = null, $where = null)
    {
        $this->db->update($table, $data, $where);
    }

    function notif($table = null, $data = null)
    {
        $this->db->update($table, $data);
    }
    function notif1($table = null, $data = null, $where = null)
    {
        $this->db->group_start();
        // $this->db->or_where('prog',"Karantina Qur'an 1 Tahun");
        $this->db->or_where('prog', "Karantina Qur'an 6 Bulan");
        $this->db->or_where('prog', "Dauroh Qur'an 30 Hari");
        $this->db->group_end();
        $this->db->update($table, $data, $whare);
    }

    function notif2($table = null, $data = null, $where = null)
    {
        $this->db->group_start();
        // $this->db->or_where('prog','DH Institute S1 Double Gelar');
        $this->db->or_where('prog', 'SMP & SMA Tahfidz Boarding');
        $this->db->group_end();
        $this->db->update($table, $data, $whare);
    }

    function notif3($table = null, $data = null, $where = null)
    {
        $this->db->group_start();
        // $this->db->or_where('prog','DH Institute S1 Double Gelar');
        $this->db->or_where('prog', 'Tahfidz Online');
        $this->db->group_end();
        $this->db->update($table, $data, $whare);
    }

    function hapus_pesan($id)
    {
        $hsl = $this->db->query("DELETE FROM tbl_inbox WHERE id='$id'");
        return $hsl;
    }

    function pmb_karantina()
    {
        $this->db->select('*');
        $this->db->from('tbl_pmb_karantina');
        $this->db->order_by('id_pmb_karantina', 'desc');
        return $this->db->get();
    }

    function pmb_po()
    {
        $this->db->select('*');
        $this->db->from('tbl_pmb_po');
        $this->db->join('kelas_program_po', 'tbl_pmb_po.kelas=kelas_program_po.id');
        $this->db->order_by('id_pmb_po', 'desc');
        return $this->db->get();
    }

    function pmb_boarding()
    {
        $this->db->select('*');
        $this->db->from('tbl_pmb_boarding');
        $this->db->order_by('id_pmb', 'desc');
        return $this->db->get();
    }

    function pmb_institute()
    {
        $this->db->select('*');
        $this->db->from('tbl_pmb_institute');
        $this->db->order_by('id_pmb', 'desc');
        return $this->db->get();
    }

    function get_detail_pmb($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_pmb_karantina');
        $this->db->join('provinces', 'tbl_pmb_karantina.prov=provinces.id');
        $this->db->join('regencies', 'tbl_pmb_karantina.kab=regencies.id');
        $this->db->join('districts', 'tbl_pmb_karantina.kec=districts.id');
        $this->db->where('id_pmb_karantina', $id);
        return $this->db->get();
    }

    function get_detail_institute($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_pmb_institute');
        $this->db->join('provinces', 'tbl_pmb_institute.prov=provinces.id');
        $this->db->join('regencies', 'tbl_pmb_institute.kab=regencies.id');
        $this->db->join('districts', 'tbl_pmb_institute.kec=districts.id');
        $this->db->where('id_pmb', $id);
        return $this->db->get();
    }
    function get_detail_boarding($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_pmb_boarding');
        $this->db->join('provinces', 'tbl_pmb_boarding.prov=provinces.id');
        $this->db->join('regencies', 'tbl_pmb_boarding.kab=regencies.id');
        $this->db->join('districts', 'tbl_pmb_boarding.kec=districts.id');
        $this->db->where('id_pmb', $id);
        return $this->db->get();
    }

    function get_login($table, $where, $where1)
    {
        $this->db->from($table);
        $this->db->where($where);
        $this->db->where($where1);
        return $this->db->get();
    }

    function multi_where($table, $where, $where1)
    {
        $this->db->from($table);
        $this->db->where($where);
        $this->db->where($where1);
        return $this->db->get();
    }
}