<?php

namespace Ais\PertemuanBundle\Entity;

use Doctrine\ORM\Mapping;
use Ais\PertemuanBundle\Model\PertemuanInterface;

/**
 * Pertemuan
 */
class Pertemuan implements PertemuanInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $jadwal_id;

    /**
     * @var \DateTime
     */
    private $tanggal;

    /**
     * @var string
     */
    private $mulai;

    /**
     * @var string
     */
    private $akhir;

    /**
     * @var integer
     */
    private $hari_id;

    /**
     * @var integer
     */
    private $ruang_id;

    /**
     * @var string
     */
    private $materi;

    /**
     * @var boolean
     */
    private $sesuai;

    /**
     * @var string
     */
    private $keterangan;

    /**
     * @var boolean
     */
    private $is_delete;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set jadwalId
     *
     * @param integer $jadwalId
     *
     * @return Pertemuan
     */
    public function setJadwalId($jadwalId)
    {
        $this->jadwal_id = $jadwalId;

        return $this;
    }

    /**
     * Get jadwalId
     *
     * @return integer
     */
    public function getJadwalId()
    {
        return $this->jadwal_id;
    }

    /**
     * Set tanggal
     *
     * @param \DateTime $tanggal
     *
     * @return Pertemuan
     */
    public function setTanggal($tanggal)
    {
        $this->tanggal = $tanggal;

        return $this;
    }

    /**
     * Get tanggal
     *
     * @return \DateTime
     */
    public function getTanggal()
    {
        return $this->tanggal;
    }

    /**
     * Set mulai
     *
     * @param string $mulai
     *
     * @return Pertemuan
     */
    public function setMulai($mulai)
    {
        $this->mulai = $mulai;

        return $this;
    }

    /**
     * Get mulai
     *
     * @return string
     */
    public function getMulai()
    {
        return $this->mulai;
    }

    /**
     * Set akhir
     *
     * @param string $akhir
     *
     * @return Pertemuan
     */
    public function setAkhir($akhir)
    {
        $this->akhir = $akhir;

        return $this;
    }

    /**
     * Get akhir
     *
     * @return string
     */
    public function getAkhir()
    {
        return $this->akhir;
    }

    /**
     * Set hariId
     *
     * @param integer $hariId
     *
     * @return Pertemuan
     */
    public function setHariId($hariId)
    {
        $this->hari_id = $hariId;

        return $this;
    }

    /**
     * Get hariId
     *
     * @return integer
     */
    public function getHariId()
    {
        return $this->hari_id;
    }

    /**
     * Set ruangId
     *
     * @param integer $ruangId
     *
     * @return Pertemuan
     */
    public function setRuangId($ruangId)
    {
        $this->ruang_id = $ruangId;

        return $this;
    }

    /**
     * Get ruangId
     *
     * @return integer
     */
    public function getRuangId()
    {
        return $this->ruang_id;
    }

    /**
     * Set materi
     *
     * @param string $materi
     *
     * @return Pertemuan
     */
    public function setMateri($materi)
    {
        $this->materi = $materi;

        return $this;
    }

    /**
     * Get materi
     *
     * @return string
     */
    public function getMateri()
    {
        return $this->materi;
    }

    /**
     * Set sesuai
     *
     * @param boolean $sesuai
     *
     * @return Pertemuan
     */
    public function setSesuai($sesuai)
    {
        $this->sesuai = $sesuai;

        return $this;
    }

    /**
     * Get sesuai
     *
     * @return boolean
     */
    public function getSesuai()
    {
        return $this->sesuai;
    }

    /**
     * Set keterangan
     *
     * @param string $keterangan
     *
     * @return Pertemuan
     */
    public function setKeterangan($keterangan)
    {
        $this->keterangan = $keterangan;

        return $this;
    }

    /**
     * Get keterangan
     *
     * @return string
     */
    public function getKeterangan()
    {
        return $this->keterangan;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Pertemuan
     */
    public function setIsDelete($isDelete)
    {
        $this->is_delete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->is_delete;
    }
}

