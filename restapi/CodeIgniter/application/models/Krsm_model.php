<?php

class Krsm_Model extends CI_Model
{
    protected $KrsmTable = 'tem_krsm';
    protected $KrsmDetailTabel = 'tem_detail_krsm';
    protected $DosenWaliTabel = 'dosen_wali';
    protected $ProgramStudiTabel = 'program_studi';
    protected $PengampuhTabel = 'dosen_pengampu';
    protected $BaakTabel = 'baak';

    public function insert_user(array $UserData)
    {
        $this->db->insert($this->UserTable, $UserData);
        return $this->db->insert_id();
    }

    public function fetch_all_jadwal($IdUser)
    {
        $this->db->select('*');
        $this->db->where('IdUser', $IdUser);
        $Mahasiswa = $this->db->get($this->MahasiswaTable);
        $StatusTA = "AKTIF";

        foreach ($Mahasiswa->result() as $value) {
            $DataMahasiswa = $value;
        }
        if ($Mahasiswa->num_rows()) {
            if ($DataMahasiswa->statuskul == "TIDAK AKTIF" ||
                $DataMahasiswa->statuskul == "TRANSFER" ||
                $DataMahasiswa->statuskul == "CUTI") {
                $this->db->select('*');
                $this->db->where('status', $StatusTA);
                $DataTahunAkademik = $this->db->get($this->TahunAkademikTable);

                foreach ($DataTahunAkademik->result() as $value) {
                    $DataTA = $value;
                }
                // $this->db->where();
                if ($DataTahunAkademik->num_rows()) {
                    $this->db->select('*');
                    $this->db->join('matakuliah', 'matakuliah.kmk = jadwal_kuliah.kmk', 'left');
                    $this->db->where('jadwal_kuliah.kdps', $DataMahasiswa->kdps);
                    $this->db->where('thakademik', $DataTA->thakademik);
                    $this->db->where('gg', $DataTA->gg);
                    $this->db->where('kelas', $DataMahasiswa->kelas);
                    $this->db->group_start();
                    $this->db->where('kurikulum', $DataMahasiswa->kurikulum);
                    $this->db->or_where('kurikulum', 'ALL');
                    $this->db->group_end();
                    $this->db->order_by('matakuliah.smt', 'ASC');
                    $DataJadwal = $this->db->get($this->JadwalTable);

                }
                return $DataJadwal->result();
            }
        } else {

        }
    }

    public function GetTem($data, $status)
    {
        $temKrsm;
        if ($status == "Keuangan") {
            $this->db->where("IdUser", $data->id);
            $ItemPegawai = $temKrsm = $this->db->get('pegawai');
            $this->db->select("
            `tem_krsm`.`Id`,
            `tem_krsm`.`thakademik`,
            `tem_krsm`.`gg`,
            `tem_krsm`.`npm`,
            `tem_krsm`.`sms`,
            `tem_krsm`.`dsn_wali`,
            `tem_krsm`.`ketjur`,
            `tem_krsm`.`admakademik`,
            `tem_krsm`.`jmsks`,
            `tem_krsm`.`tgkrsm`,
            `tem_krsm`.`status`,
            `mahasiswa`.`nmmhs`,
            `mahasiswa`.`kelas`");
            $this->db->join("mahasiswa", "`mahasiswa`.`npm` = `tem_krsm`.`npm`", "LEFT");
            $this->db->where('tem_krsm.status', $status);
            $this->db->where('tem_krsm.status', $status);
            $temKrsm = $this->db->get('tem_krsm');

        } else {

            $this->db->select("`tem_krsm`.`Id`,
            `tem_krsm`.`Id`,
            `tem_krsm`.`thakademik`,
            `tem_krsm`.`gg`,
            `tem_krsm`.`npm`,
            `tem_krsm`.`sms`,
            `tem_krsm`.`dsn_wali`,
            `tem_krsm`.`ketjur`,
            `tem_krsm`.`admakademik`,
            `tem_krsm`.`jmsks`,
            `tem_krsm`.`tgkrsm`,
            `tem_krsm`.`status`,
            `dosen`.`nmdsn`,
            `dosen`.`nidn`,
            `mahasiswa`.`nmmhs`,
            `mahasiswa`.`kelas`");
            $this->db->join('dosen_wali', 'dosen_wali.npm=tem_krsm.npm', 'left');
            $this->db->join('dosen', 'dosen.nidn=dosen_wali.nidn', 'right');
            $this->db->join('pegawai', 'pegawai.idpegawai=dosen.idpegawai', 'right');
            $this->db->join("mahasiswa", "`mahasiswa`.`npm` = `tem_krsm`.`npm`", "LEFT");
            $this->db->where('tem_krsm`.`status`', $status);
            $this->db->where('pegawai.IdUser', $data->id);

            $temKrsm = $this->db->get('tem_krsm');
        }
        $DatasTemKrsm = array(
            'TemKrsm' => array(),
        );
        foreach ($temKrsm->result() as $value) {
            $ItemTemKrsm = [
                'Id' => $value->Id,
                'thakademik' => $value->thakademik,
                'gg' => $value->gg,
                'npm' => $value->npm,
                'sms' => $value->sms,
                'dsn_wali' => $value->dsn_wali,
                'ketjur' => $value->ketjur,
                'admakademik' => $value->admakademik,
                'jmsks' => $value->jmsks,
                'tgkrsm' => $value->tgkrsm,
                'status' => $value->status,
                'nmmhs' => $value->nmmhs,
                'kelas' => $value->kelas,
                'detailTemKrsm' => array(),
            ];
            $this->db->where('IdKrsm', $value->Id);
            $itemDetailTem = $this->db->get('tem_detail_krsm');
            array_push($ItemTemKrsm['detailTemKrsm'], $itemDetailTem->result());
            array_push($DatasTemKrsm['TemKrsm'], $ItemTemKrsm);
        }
        return $DatasTemKrsm;
        // $Keuangan = false;
        // $Wali = false;
        // $Prodi = false;
        // foreach ($userinrole->result() as $value) {
        //     if ($value->RoleId == "9" || $value->RoleId == 9) {
        //         $Keuangan = true;
        //     } else if ($value->RoleId == "1" || $value->RoleId == 1) {
        //         $Prodi = true;
        //     } else if($value->RoleId == "7" || $value->RoleId == 7) {
        //         $Wali = true;
        //     }
        // }
        if ($status == 'Keuangan') {

        }
        // $this->db->where('npm', $data);
        // $resultKrsm = $this->db->get($this->KrsmTable);
        // $num =$resultKrsm->num_rows();
        // if($num>0){
        //     $this->db->where('IdKrsm', $result->row('Id'));
        //     $resultDetailKrsm = $this->db->get($this->KrsmDetailTabel);
        //     $Datas = array(
        //         'Krsm' => $resultKrsm->result(),
        //         'DetailKrsm' => $resultDetailKrsm->result()
        //     );
        //     return $Datas;
        // }
    }

    public function UpdateTemKrsm($item)
    {
        if ($item['status'] == "Keuangan") {
            $Itemset = "Dosen Wali";
            $Id = $item['Id'];
            $this->db->set('status', $Itemset);
            $this->db->where('Id', $Id);
            $hasil = $this->db->update('tem_krsm');
            return $hasil;
        } else if ($item['status'] == "Dosen Wali") {
            $Itemset = "Prodi";
            $Id = $item['Id'];
            $this->db->set('status', $Itemset);
            $this->db->where('Id', $Id);
            $hasil = $this->db->update('tem_krsm');
            return $hasil;
        } else {
            $ItemData = (object) $item;
            $this->db->trans_begin();
            $Data_Krsm = [
                'thakademik' => $ItemData->thakademik,
                'gg' => $ItemData->gg,
                'npm' => $ItemData->npm,
                'sms' => $ItemData->sms,
                'dsn_wali' => $ItemData->dsn_wali,
                'ketjur' => $ItemData->ketjur,
                'admakademik' => $ItemData->admakademik,
                'jmsks' => $ItemData->jmsks,
                'tgkrsm' => $ItemData->tgkrsm,
            ];
            
            $this->db->insert('krsm', $Data_Krsm);
            $IdKrsm = $this->db->insert_id();
            foreach ($ItemData->detailTemKrsm[0] as $key => $value) {
                $DetaiTemKrsm = array(
                    'thakademik' => $ItemData->thakademik,
                    'gg' => $value['gg'],
                    'npm' => $value['npm'],
                    'kmk' => $value['kmk'],
                    'nidn' => $value['nidn'],
                    'dsnampu' => $value['dsnampu'],
                    'nmmk' => $value['nmmk'],
                    'bup' => $value['bup'],
                    'sks' => $value['sks'],
                    'smt' => $value['smt'],
                    'kelas' => $value['kelas'],
                    'IdKrsm' => $IdKrsm,
                );
                $this->db->insert('krsm_detail', $DetaiTemKrsm);
            }
            $this->db->where('IdKrsm', $ItemData->Id);
            $this->db->delete($this->KrsmDetailTabel);
            $this->db->where('Id', $ItemData->Id);
            $this->db->delete($this->KrsmTable);
            $this->db->set('stdu', 'AKTIF');
            $this->db->where('thakademik', $ItemData->thakademik);
            $this->db->where('thakademik', $ItemData->gg);
            $this->db->where('npm', $ItemData->npm);
            $this->db->where('stdu !=', 'PINDAH/TRANS');
            $this->db->update('daftar_ulang');
            $this->db->set('statuskul', 'AKTIF');
            $this->db->where('npm', $ItemData->npm);
            $this->db->update('mahasiswa');
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
    }

    // public function InsertItemKrsm($item)
    // {
    //     $this->db->where('npm', $item->npm);
    //     $CekTemKrsm = $this->db->get($this->KrsmTable);
    //
    // }

    public function DeleteItemKRSM($item)
    {
        $this->db->where('Id', $item);
        $result = $this->db->delete('tem_detail_krsm');
        return $result;
    }

    public function Inser_Pengajuan($data, $b)
    {
        $this->db->where('npm', $data->npm);
        $CekKrsm = $this->db->get($this->KrsmTable);
        if ($CekKrsm->num_rows() != 0) {
            $this->db->where('thakademik', $data->thakademik);
            $this->db->where('gg', $data->gg);
            $this->db->where('kmk', $b->kmk);
            $this->db->where('kdps', $data->kdps);
            $Dosenampu = $this->db->get($this->PengampuhTabel);
            $this->db->where('npm', $data->npm);
            $this->db->where('kmk', $data->kmk);
            $CekMatakuliah = $this->db->get('khsm_detail');
            $BUP = "";
            if ($CekMatakuliah->num_rows() == 0) {
                $BUP = "B";
            } else {
                $BUP = "UP";
            }

            $DetaiTemKrsm = array(
                'gg' => $data->gg,
                'npm' => $data->npm,
                'kmk' => $b->kmk,
                'nidn' => $Dosenampu->row('nidn'),
                'dsnampu' => $b->dsn_saji,
                'nmmk' => $b->nmmk,
                'bup' => $BUP,
                'sks' => $b->sks,
                'smt' => $b->smt,
                'kelas' => $b->kelas,
                'IdKrsm' => $CekKrsm->row('Id'),
            );
            $this->db->insert($this->KrsmDetailTabel, $DetaiTemKrsm);
        } else {
            $this->db->select('*');
            $this->db->join('dosen', 'dosen.nidn = dosen_wali.nidn', 'left');
            $this->db->where('npm', $data->npm);
            $GetWali = $this->db->get($this->DosenWaliTabel);
            if ($GetWali->num_rows()) {
                $this->db->where('kdps', $data->kdps);
                $GetJurusan = $this->db->get($this->ProgramStudiTabel);
                if ($GetJurusan->num_rows()) {
                    $this->db->select("*");
                    $baak = $this->db->get($this->BaakTabel);
                    if ($baak->num_rows()) {
                        $this->db->trans_begin();
                        $this->db->where('npm', $data->npm);
                        $JumKRS = $this->db->get('daftar_ulang');
                        $Data_Krsm = [
                            'thakademik' => $data->thakademik,
                            'gg' => $data->gg,
                            'npm' => $data->npm,
                            'sms' => $JumKRS->num_rows() + 1,
                            'dsn_wali' => $GetWali->row('nmdsn'),
                            'ketjur' => $GetJurusan->row('kaprodi'),
                            'admakademik' => $baak->row('adm'),
                            'jmsks' => $data->jmsks,
                            'tgkrsm' => date("Y-m-d"),
                        ];
                        $this->db->insert($this->KrsmTable, $Data_Krsm);
                        $IdTemKrsm = $this->db->insert_id();
                        foreach ($b as $key => $value) {
                            $this->db->where('thakademik', $data->thakademik);
                            $this->db->where('gg', $data->gg);
                            $this->db->where('kmk', $value['kmk']);
                            $this->db->where('kdps', $data->kdps);
                            $Dosenampu = $this->db->get($this->PengampuhTabel);
                            $this->db->where('npm', $data->npm);
                            $this->db->where('kmk', $value['kmk']);
                            $CekMatakuliah = $this->db->get('khsm_detail');
                            $BUP = "";
                            if ($CekMatakuliah->num_rows() == 0) {
                                $BUP = "B";
                            } else {
                                $BUP = "UP";
                            }

                            $DetaiTemKrsm = array(
                                'gg' => $value['gg'],
                                'npm' => $data->npm,
                                'kmk' => $value['kmk'],
                                'nidn' => $Dosenampu->row('nidn'),
                                'dsnampu' => $value['dsn_saji'],
                                'nmmk' => $value['nmmk'],
                                'bup' => $BUP,
                                'sks' => $value['sks'],
                                'smt' => $value['smt'],
                                'kelas' => $value['kelas'],
                                'IdKrsm' => $IdTemKrsm,
                            );
                            $this->db->insert($this->KrsmDetailTabel, $DetaiTemKrsm);
                        }
                        if ($this->db->trans_status() === false) {
                            $this->db->trans_rollback();
                            return false;
                        } else {
                            $this->db->trans_commit();
                            return true;
                        }
                    }
                }
            } else {
                return false;
            }
        }

        // $this->db->insert($this->UserTable, $UserData);
        // $IdKHS = $this->db->insert_id();
    }
}
