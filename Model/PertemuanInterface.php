<?php

namespace Ais\PertemuanBundle\Model;

Interface PertemuanInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set jadwalId
     *
     * @param integer $jadwalId
     *
     * @return Pertemuan
     */
    public function setJadwalId($jadwalId);

    /**
     * Get jadwalId
     *
     * @return integer
     */
    public function getJadwalId();

    /**
     * Set tanggal
     *
     * @param \DateTime $tanggal
     *
     * @return Pertemuan
     */
    public function setTanggal($tanggal);

    /**
     * Get tanggal
     *
     * @return \DateTime
     */
    public function getTanggal();

    /**
     * Set mulai
     *
     * @param string $mulai
     *
     * @return Pertemuan
     */
    public function setMulai($mulai);

    /**
     * Get mulai
     *
     * @return string
     */
    public function getMulai();

    /**
     * Set akhir
     *
     * @param string $akhir
     *
     * @return Pertemuan
     */
    public function setAkhir($akhir);

    /**
     * Get akhir
     *
     * @return string
     */
    public function getAkhir();

    /**
     * Set hariId
     *
     * @param integer $hariId
     *
     * @return Pertemuan
     */
    public function setHariId($hariId);

    /**
     * Get hariId
     *
     * @return integer
     */
    public function getHariId();

    /**
     * Set ruangId
     *
     * @param integer $ruangId
     *
     * @return Pertemuan
     */
    public function setRuangId($ruangId);

    /**
     * Get ruangId
     *
     * @return integer
     */
    public function getRuangId();

    /**
     * Set materi
     *
     * @param string $materi
     *
     * @return Pertemuan
     */
    public function setMateri($materi);

    /**
     * Get materi
     *
     * @return string
     */
    public function getMateri();

    /**
     * Set sesuai
     *
     * @param boolean $sesuai
     *
     * @return Pertemuan
     */
    public function setSesuai($sesuai);

    /**
     * Get sesuai
     *
     * @return boolean
     */
    public function getSesuai();

    /**
     * Set keterangan
     *
     * @param string $keterangan
     *
     * @return Pertemuan
     */
    public function setKeterangan($keterangan);

    /**
     * Get keterangan
     *
     * @return string
     */
    public function getKeterangan();

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Pertemuan
     */
    public function setIsDelete($isDelete);

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete();
}
