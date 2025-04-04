<?php

namespace App\Dto\Tmdb\Clients\CertificationApi;

use App\Dto\Tmdb\Responses\Certification\CertificationMovieList;
use App\Dto\Tmdb\Responses\Certification\CertificationsTvList;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
interface CertificationApiInterface
{
    /**
     * /3/certification/movie/list - Get an up to date list of the officially supported movie certifications on TMDB.
     */
    public function certificationMovieList(): CertificationMovieList;

    /**
     * /3/certification/tv/list
     */
    public function certificationsTvList(): CertificationsTvList;
}