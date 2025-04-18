<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeriesWatchProvidersResults
{
    #[SerializedName('AE')]
    private ?TvSeriesWatchProvidersResultsAE $AE = null;
    #[SerializedName('AR')]
    private ?TvSeriesWatchProvidersResultsAR $AR = null;
    #[SerializedName('AT')]
    private ?TvSeriesWatchProvidersResultsAT $AT = null;
    #[SerializedName('AU')]
    private ?TvSeriesWatchProvidersResultsAU $AU = null;
    #[SerializedName('BA')]
    private ?TvSeriesWatchProvidersResultsBA $BA = null;
    #[SerializedName('BB')]
    private ?TvSeriesWatchProvidersResultsBB $BB = null;
    #[SerializedName('BE')]
    private ?TvSeriesWatchProvidersResultsBE $BE = null;
    #[SerializedName('BG')]
    private ?TvSeriesWatchProvidersResultsBG $BG = null;
    #[SerializedName('BO')]
    private ?TvSeriesWatchProvidersResultsBO $BO = null;
    #[SerializedName('BR')]
    private ?TvSeriesWatchProvidersResultsBR $BR = null;
    #[SerializedName('BS')]
    private ?TvSeriesWatchProvidersResultsBS $BS = null;
    #[SerializedName('CA')]
    private ?TvSeriesWatchProvidersResultsCA $CA = null;
    #[SerializedName('CH')]
    private ?TvSeriesWatchProvidersResultsCH $CH = null;
    #[SerializedName('CI')]
    private ?TvSeriesWatchProvidersResultsCI $CI = null;
    #[SerializedName('CL')]
    private ?TvSeriesWatchProvidersResultsCL $CL = null;
    #[SerializedName('CO')]
    private ?TvSeriesWatchProvidersResultsCO $CO = null;
    #[SerializedName('CR')]
    private ?TvSeriesWatchProvidersResultsCR $CR = null;
    #[SerializedName('CZ')]
    private ?TvSeriesWatchProvidersResultsCZ $CZ = null;
    #[SerializedName('DE')]
    private ?TvSeriesWatchProvidersResultsDE $DE = null;
    #[SerializedName('DK')]
    private ?TvSeriesWatchProvidersResultsDK $DK = null;
    #[SerializedName('DO')]
    private ?TvSeriesWatchProvidersResultsDO $DO = null;
    #[SerializedName('DZ')]
    private ?TvSeriesWatchProvidersResultsDZ $DZ = null;
    #[SerializedName('EC')]
    private ?TvSeriesWatchProvidersResultsEC $EC = null;
    #[SerializedName('EG')]
    private ?TvSeriesWatchProvidersResultsEG $EG = null;
    #[SerializedName('ES')]
    private ?TvSeriesWatchProvidersResultsES $ES = null;
    #[SerializedName('FI')]
    private ?TvSeriesWatchProvidersResultsFI $FI = null;
    #[SerializedName('FR')]
    private ?TvSeriesWatchProvidersResultsFR $FR = null;
    #[SerializedName('GB')]
    private ?TvSeriesWatchProvidersResultsGB $GB = null;
    #[SerializedName('GF')]
    private ?TvSeriesWatchProvidersResultsGF $GF = null;
    #[SerializedName('GH')]
    private ?TvSeriesWatchProvidersResultsGH $GH = null;
    #[SerializedName('GQ')]
    private ?TvSeriesWatchProvidersResultsGQ $GQ = null;
    #[SerializedName('GT')]
    private ?TvSeriesWatchProvidersResultsGT $GT = null;
    #[SerializedName('HK')]
    private ?TvSeriesWatchProvidersResultsHK $HK = null;
    #[SerializedName('HN')]
    private ?TvSeriesWatchProvidersResultsHN $HN = null;
    #[SerializedName('HR')]
    private ?TvSeriesWatchProvidersResultsHR $HR = null;
    #[SerializedName('HU')]
    private ?TvSeriesWatchProvidersResultsHU $HU = null;
    #[SerializedName('ID')]
    private ?TvSeriesWatchProvidersResultsID $ID = null;
    #[SerializedName('IE')]
    private ?TvSeriesWatchProvidersResultsIE $IE = null;
    #[SerializedName('IL')]
    private ?TvSeriesWatchProvidersResultsIL $IL = null;
    #[SerializedName('IQ')]
    private ?TvSeriesWatchProvidersResultsIQ $IQ = null;
    #[SerializedName('IT')]
    private ?TvSeriesWatchProvidersResultsIT $IT = null;
    #[SerializedName('JM')]
    private ?TvSeriesWatchProvidersResultsJM $JM = null;
    #[SerializedName('JP')]
    private ?TvSeriesWatchProvidersResultsJP $JP = null;
    #[SerializedName('KE')]
    private ?TvSeriesWatchProvidersResultsKE $KE = null;
    #[SerializedName('KR')]
    private ?TvSeriesWatchProvidersResultsKR $KR = null;
    #[SerializedName('LB')]
    private ?TvSeriesWatchProvidersResultsLB $LB = null;
    #[SerializedName('LT')]
    private ?TvSeriesWatchProvidersResultsLT $LT = null;
    #[SerializedName('LY')]
    private ?TvSeriesWatchProvidersResultsLY $LY = null;
    #[SerializedName('MD')]
    private ?TvSeriesWatchProvidersResultsMD $MD = null;
    #[SerializedName('MK')]
    private ?TvSeriesWatchProvidersResultsMK $MK = null;
    #[SerializedName('MU')]
    private ?TvSeriesWatchProvidersResultsMU $MU = null;
    #[SerializedName('MX')]
    private ?TvSeriesWatchProvidersResultsMX $MX = null;
    #[SerializedName('MY')]
    private ?TvSeriesWatchProvidersResultsMY $MY = null;
    #[SerializedName('MZ')]
    private ?TvSeriesWatchProvidersResultsMZ $MZ = null;
    #[SerializedName('NE')]
    private ?TvSeriesWatchProvidersResultsNE $NE = null;
    #[SerializedName('NG')]
    private ?TvSeriesWatchProvidersResultsNG $NG = null;
    #[SerializedName('NL')]
    private ?TvSeriesWatchProvidersResultsNL $NL = null;
    #[SerializedName('NO')]
    private ?TvSeriesWatchProvidersResultsNO $NO = null;
    #[SerializedName('NZ')]
    private ?TvSeriesWatchProvidersResultsNZ $NZ = null;
    #[SerializedName('PA')]
    private ?TvSeriesWatchProvidersResultsPA $PA = null;
    #[SerializedName('PE')]
    private ?TvSeriesWatchProvidersResultsPE $PE = null;
    #[SerializedName('PH')]
    private ?TvSeriesWatchProvidersResultsPH $PH = null;
    #[SerializedName('PL')]
    private ?TvSeriesWatchProvidersResultsPL $PL = null;
    #[SerializedName('PS')]
    private ?TvSeriesWatchProvidersResultsPS $PS = null;
    #[SerializedName('PT')]
    private ?TvSeriesWatchProvidersResultsPT $PT = null;
    #[SerializedName('PY')]
    private ?TvSeriesWatchProvidersResultsPY $PY = null;
    #[SerializedName('RO')]
    private ?TvSeriesWatchProvidersResultsRO $RO = null;
    #[SerializedName('RS')]
    private ?TvSeriesWatchProvidersResultsRS $RS = null;
    #[SerializedName('RU')]
    private ?TvSeriesWatchProvidersResultsRU $RU = null;
    #[SerializedName('SA')]
    private ?TvSeriesWatchProvidersResultsSA $SA = null;
    #[SerializedName('SC')]
    private ?TvSeriesWatchProvidersResultsSC $SC = null;
    #[SerializedName('SE')]
    private ?TvSeriesWatchProvidersResultsSE $SE = null;
    #[SerializedName('SG')]
    private ?TvSeriesWatchProvidersResultsSG $SG = null;
    #[SerializedName('SI')]
    private ?TvSeriesWatchProvidersResultsSI $SI = null;
    #[SerializedName('SK')]
    private ?TvSeriesWatchProvidersResultsSK $SK = null;
    #[SerializedName('SN')]
    private ?TvSeriesWatchProvidersResultsSN $SN = null;
    #[SerializedName('SV')]
    private ?TvSeriesWatchProvidersResultsSV $SV = null;
    #[SerializedName('TH')]
    private ?TvSeriesWatchProvidersResultsTH $TH = null;
    #[SerializedName('TR')]
    private ?TvSeriesWatchProvidersResultsTR $TR = null;
    #[SerializedName('TT')]
    private ?TvSeriesWatchProvidersResultsTT $TT = null;
    #[SerializedName('TW')]
    private ?TvSeriesWatchProvidersResultsTW $TW = null;
    #[SerializedName('TZ')]
    private ?TvSeriesWatchProvidersResultsTZ $TZ = null;
    #[SerializedName('UG')]
    private ?TvSeriesWatchProvidersResultsUG $UG = null;
    #[SerializedName('US')]
    private ?TvSeriesWatchProvidersResultsUS $US = null;
    #[SerializedName('UY')]
    private ?TvSeriesWatchProvidersResultsUY $UY = null;
    #[SerializedName('VE')]
    private ?TvSeriesWatchProvidersResultsVE $VE = null;
    #[SerializedName('ZA')]
    private ?TvSeriesWatchProvidersResultsZA $ZA = null;
    #[SerializedName('ZM')]
    private ?TvSeriesWatchProvidersResultsZM $ZM = null;

    public static function fromArray(array $data = []): self
    {
        $typeExtractor = new PropertyInfoExtractor(typeExtractors: [new PhpDocExtractor(), new PropertyInfoExtractor()]);
        $serializer = new Serializer([new ObjectNormalizer(
            nameConverter: new CamelCaseToSnakeCaseNameConverter(),  propertyTypeExtractor: $typeExtractor),
            new ArrayDenormalizer()
        ]);
        return $serializer->denormalize($data, self::class);
    }

    public function toArray(): array
    {
        $typeExtractor = new PropertyInfoExtractor(typeExtractors: [new PhpDocExtractor(), new PropertyInfoExtractor()]);
        $serializer = new Serializer([new ObjectNormalizer(
            nameConverter: new CamelCaseToSnakeCaseNameConverter(),
            propertyTypeExtractor: $typeExtractor
        )]);
        return $serializer->normalize($this);
    }

    public function getAE(): ?TvSeriesWatchProvidersResultsAE
    {
        return $this->AE;
    }

    public function setAE(?TvSeriesWatchProvidersResultsAE $AE): self
    {
        $this->AE = $AE;

        return $this;
    }

    public function getAR(): ?TvSeriesWatchProvidersResultsAR
    {
        return $this->AR;
    }

    public function setAR(?TvSeriesWatchProvidersResultsAR $AR): self
    {
        $this->AR = $AR;

        return $this;
    }

    public function getAT(): ?TvSeriesWatchProvidersResultsAT
    {
        return $this->AT;
    }

    public function setAT(?TvSeriesWatchProvidersResultsAT $AT): self
    {
        $this->AT = $AT;

        return $this;
    }

    public function getAU(): ?TvSeriesWatchProvidersResultsAU
    {
        return $this->AU;
    }

    public function setAU(?TvSeriesWatchProvidersResultsAU $AU): self
    {
        $this->AU = $AU;

        return $this;
    }

    public function getBA(): ?TvSeriesWatchProvidersResultsBA
    {
        return $this->BA;
    }

    public function setBA(?TvSeriesWatchProvidersResultsBA $BA): self
    {
        $this->BA = $BA;

        return $this;
    }

    public function getBB(): ?TvSeriesWatchProvidersResultsBB
    {
        return $this->BB;
    }

    public function setBB(?TvSeriesWatchProvidersResultsBB $BB): self
    {
        $this->BB = $BB;

        return $this;
    }

    public function getBE(): ?TvSeriesWatchProvidersResultsBE
    {
        return $this->BE;
    }

    public function setBE(?TvSeriesWatchProvidersResultsBE $BE): self
    {
        $this->BE = $BE;

        return $this;
    }

    public function getBG(): ?TvSeriesWatchProvidersResultsBG
    {
        return $this->BG;
    }

    public function setBG(?TvSeriesWatchProvidersResultsBG $BG): self
    {
        $this->BG = $BG;

        return $this;
    }

    public function getBO(): ?TvSeriesWatchProvidersResultsBO
    {
        return $this->BO;
    }

    public function setBO(?TvSeriesWatchProvidersResultsBO $BO): self
    {
        $this->BO = $BO;

        return $this;
    }

    public function getBR(): ?TvSeriesWatchProvidersResultsBR
    {
        return $this->BR;
    }

    public function setBR(?TvSeriesWatchProvidersResultsBR $BR): self
    {
        $this->BR = $BR;

        return $this;
    }

    public function getBS(): ?TvSeriesWatchProvidersResultsBS
    {
        return $this->BS;
    }

    public function setBS(?TvSeriesWatchProvidersResultsBS $BS): self
    {
        $this->BS = $BS;

        return $this;
    }

    public function getCA(): ?TvSeriesWatchProvidersResultsCA
    {
        return $this->CA;
    }

    public function setCA(?TvSeriesWatchProvidersResultsCA $CA): self
    {
        $this->CA = $CA;

        return $this;
    }

    public function getCH(): ?TvSeriesWatchProvidersResultsCH
    {
        return $this->CH;
    }

    public function setCH(?TvSeriesWatchProvidersResultsCH $CH): self
    {
        $this->CH = $CH;

        return $this;
    }

    public function getCI(): ?TvSeriesWatchProvidersResultsCI
    {
        return $this->CI;
    }

    public function setCI(?TvSeriesWatchProvidersResultsCI $CI): self
    {
        $this->CI = $CI;

        return $this;
    }

    public function getCL(): ?TvSeriesWatchProvidersResultsCL
    {
        return $this->CL;
    }

    public function setCL(?TvSeriesWatchProvidersResultsCL $CL): self
    {
        $this->CL = $CL;

        return $this;
    }

    public function getCO(): ?TvSeriesWatchProvidersResultsCO
    {
        return $this->CO;
    }

    public function setCO(?TvSeriesWatchProvidersResultsCO $CO): self
    {
        $this->CO = $CO;

        return $this;
    }

    public function getCR(): ?TvSeriesWatchProvidersResultsCR
    {
        return $this->CR;
    }

    public function setCR(?TvSeriesWatchProvidersResultsCR $CR): self
    {
        $this->CR = $CR;

        return $this;
    }

    public function getCZ(): ?TvSeriesWatchProvidersResultsCZ
    {
        return $this->CZ;
    }

    public function setCZ(?TvSeriesWatchProvidersResultsCZ $CZ): self
    {
        $this->CZ = $CZ;

        return $this;
    }

    public function getDE(): ?TvSeriesWatchProvidersResultsDE
    {
        return $this->DE;
    }

    public function setDE(?TvSeriesWatchProvidersResultsDE $DE): self
    {
        $this->DE = $DE;

        return $this;
    }

    public function getDK(): ?TvSeriesWatchProvidersResultsDK
    {
        return $this->DK;
    }

    public function setDK(?TvSeriesWatchProvidersResultsDK $DK): self
    {
        $this->DK = $DK;

        return $this;
    }

    public function getDO(): ?TvSeriesWatchProvidersResultsDO
    {
        return $this->DO;
    }

    public function setDO(?TvSeriesWatchProvidersResultsDO $DO): self
    {
        $this->DO = $DO;

        return $this;
    }

    public function getDZ(): ?TvSeriesWatchProvidersResultsDZ
    {
        return $this->DZ;
    }

    public function setDZ(?TvSeriesWatchProvidersResultsDZ $DZ): self
    {
        $this->DZ = $DZ;

        return $this;
    }

    public function getEC(): ?TvSeriesWatchProvidersResultsEC
    {
        return $this->EC;
    }

    public function setEC(?TvSeriesWatchProvidersResultsEC $EC): self
    {
        $this->EC = $EC;

        return $this;
    }

    public function getEG(): ?TvSeriesWatchProvidersResultsEG
    {
        return $this->EG;
    }

    public function setEG(?TvSeriesWatchProvidersResultsEG $EG): self
    {
        $this->EG = $EG;

        return $this;
    }

    public function getES(): ?TvSeriesWatchProvidersResultsES
    {
        return $this->ES;
    }

    public function setES(?TvSeriesWatchProvidersResultsES $ES): self
    {
        $this->ES = $ES;

        return $this;
    }

    public function getFI(): ?TvSeriesWatchProvidersResultsFI
    {
        return $this->FI;
    }

    public function setFI(?TvSeriesWatchProvidersResultsFI $FI): self
    {
        $this->FI = $FI;

        return $this;
    }

    public function getFR(): ?TvSeriesWatchProvidersResultsFR
    {
        return $this->FR;
    }

    public function setFR(?TvSeriesWatchProvidersResultsFR $FR): self
    {
        $this->FR = $FR;

        return $this;
    }

    public function getGB(): ?TvSeriesWatchProvidersResultsGB
    {
        return $this->GB;
    }

    public function setGB(?TvSeriesWatchProvidersResultsGB $GB): self
    {
        $this->GB = $GB;

        return $this;
    }

    public function getGF(): ?TvSeriesWatchProvidersResultsGF
    {
        return $this->GF;
    }

    public function setGF(?TvSeriesWatchProvidersResultsGF $GF): self
    {
        $this->GF = $GF;

        return $this;
    }

    public function getGH(): ?TvSeriesWatchProvidersResultsGH
    {
        return $this->GH;
    }

    public function setGH(?TvSeriesWatchProvidersResultsGH $GH): self
    {
        $this->GH = $GH;

        return $this;
    }

    public function getGQ(): ?TvSeriesWatchProvidersResultsGQ
    {
        return $this->GQ;
    }

    public function setGQ(?TvSeriesWatchProvidersResultsGQ $GQ): self
    {
        $this->GQ = $GQ;

        return $this;
    }

    public function getGT(): ?TvSeriesWatchProvidersResultsGT
    {
        return $this->GT;
    }

    public function setGT(?TvSeriesWatchProvidersResultsGT $GT): self
    {
        $this->GT = $GT;

        return $this;
    }

    public function getHK(): ?TvSeriesWatchProvidersResultsHK
    {
        return $this->HK;
    }

    public function setHK(?TvSeriesWatchProvidersResultsHK $HK): self
    {
        $this->HK = $HK;

        return $this;
    }

    public function getHN(): ?TvSeriesWatchProvidersResultsHN
    {
        return $this->HN;
    }

    public function setHN(?TvSeriesWatchProvidersResultsHN $HN): self
    {
        $this->HN = $HN;

        return $this;
    }

    public function getHR(): ?TvSeriesWatchProvidersResultsHR
    {
        return $this->HR;
    }

    public function setHR(?TvSeriesWatchProvidersResultsHR $HR): self
    {
        $this->HR = $HR;

        return $this;
    }

    public function getHU(): ?TvSeriesWatchProvidersResultsHU
    {
        return $this->HU;
    }

    public function setHU(?TvSeriesWatchProvidersResultsHU $HU): self
    {
        $this->HU = $HU;

        return $this;
    }

    public function getID(): ?TvSeriesWatchProvidersResultsID
    {
        return $this->ID;
    }

    public function setID(?TvSeriesWatchProvidersResultsID $ID): self
    {
        $this->ID = $ID;

        return $this;
    }

    public function getIE(): ?TvSeriesWatchProvidersResultsIE
    {
        return $this->IE;
    }

    public function setIE(?TvSeriesWatchProvidersResultsIE $IE): self
    {
        $this->IE = $IE;

        return $this;
    }

    public function getIL(): ?TvSeriesWatchProvidersResultsIL
    {
        return $this->IL;
    }

    public function setIL(?TvSeriesWatchProvidersResultsIL $IL): self
    {
        $this->IL = $IL;

        return $this;
    }

    public function getIQ(): ?TvSeriesWatchProvidersResultsIQ
    {
        return $this->IQ;
    }

    public function setIQ(?TvSeriesWatchProvidersResultsIQ $IQ): self
    {
        $this->IQ = $IQ;

        return $this;
    }

    public function getIT(): ?TvSeriesWatchProvidersResultsIT
    {
        return $this->IT;
    }

    public function setIT(?TvSeriesWatchProvidersResultsIT $IT): self
    {
        $this->IT = $IT;

        return $this;
    }

    public function getJM(): ?TvSeriesWatchProvidersResultsJM
    {
        return $this->JM;
    }

    public function setJM(?TvSeriesWatchProvidersResultsJM $JM): self
    {
        $this->JM = $JM;

        return $this;
    }

    public function getJP(): ?TvSeriesWatchProvidersResultsJP
    {
        return $this->JP;
    }

    public function setJP(?TvSeriesWatchProvidersResultsJP $JP): self
    {
        $this->JP = $JP;

        return $this;
    }

    public function getKE(): ?TvSeriesWatchProvidersResultsKE
    {
        return $this->KE;
    }

    public function setKE(?TvSeriesWatchProvidersResultsKE $KE): self
    {
        $this->KE = $KE;

        return $this;
    }

    public function getKR(): ?TvSeriesWatchProvidersResultsKR
    {
        return $this->KR;
    }

    public function setKR(?TvSeriesWatchProvidersResultsKR $KR): self
    {
        $this->KR = $KR;

        return $this;
    }

    public function getLB(): ?TvSeriesWatchProvidersResultsLB
    {
        return $this->LB;
    }

    public function setLB(?TvSeriesWatchProvidersResultsLB $LB): self
    {
        $this->LB = $LB;

        return $this;
    }

    public function getLT(): ?TvSeriesWatchProvidersResultsLT
    {
        return $this->LT;
    }

    public function setLT(?TvSeriesWatchProvidersResultsLT $LT): self
    {
        $this->LT = $LT;

        return $this;
    }

    public function getLY(): ?TvSeriesWatchProvidersResultsLY
    {
        return $this->LY;
    }

    public function setLY(?TvSeriesWatchProvidersResultsLY $LY): self
    {
        $this->LY = $LY;

        return $this;
    }

    public function getMD(): ?TvSeriesWatchProvidersResultsMD
    {
        return $this->MD;
    }

    public function setMD(?TvSeriesWatchProvidersResultsMD $MD): self
    {
        $this->MD = $MD;

        return $this;
    }

    public function getMK(): ?TvSeriesWatchProvidersResultsMK
    {
        return $this->MK;
    }

    public function setMK(?TvSeriesWatchProvidersResultsMK $MK): self
    {
        $this->MK = $MK;

        return $this;
    }

    public function getMU(): ?TvSeriesWatchProvidersResultsMU
    {
        return $this->MU;
    }

    public function setMU(?TvSeriesWatchProvidersResultsMU $MU): self
    {
        $this->MU = $MU;

        return $this;
    }

    public function getMX(): ?TvSeriesWatchProvidersResultsMX
    {
        return $this->MX;
    }

    public function setMX(?TvSeriesWatchProvidersResultsMX $MX): self
    {
        $this->MX = $MX;

        return $this;
    }

    public function getMY(): ?TvSeriesWatchProvidersResultsMY
    {
        return $this->MY;
    }

    public function setMY(?TvSeriesWatchProvidersResultsMY $MY): self
    {
        $this->MY = $MY;

        return $this;
    }

    public function getMZ(): ?TvSeriesWatchProvidersResultsMZ
    {
        return $this->MZ;
    }

    public function setMZ(?TvSeriesWatchProvidersResultsMZ $MZ): self
    {
        $this->MZ = $MZ;

        return $this;
    }

    public function getNE(): ?TvSeriesWatchProvidersResultsNE
    {
        return $this->NE;
    }

    public function setNE(?TvSeriesWatchProvidersResultsNE $NE): self
    {
        $this->NE = $NE;

        return $this;
    }

    public function getNG(): ?TvSeriesWatchProvidersResultsNG
    {
        return $this->NG;
    }

    public function setNG(?TvSeriesWatchProvidersResultsNG $NG): self
    {
        $this->NG = $NG;

        return $this;
    }

    public function getNL(): ?TvSeriesWatchProvidersResultsNL
    {
        return $this->NL;
    }

    public function setNL(?TvSeriesWatchProvidersResultsNL $NL): self
    {
        $this->NL = $NL;

        return $this;
    }

    public function getNO(): ?TvSeriesWatchProvidersResultsNO
    {
        return $this->NO;
    }

    public function setNO(?TvSeriesWatchProvidersResultsNO $NO): self
    {
        $this->NO = $NO;

        return $this;
    }

    public function getNZ(): ?TvSeriesWatchProvidersResultsNZ
    {
        return $this->NZ;
    }

    public function setNZ(?TvSeriesWatchProvidersResultsNZ $NZ): self
    {
        $this->NZ = $NZ;

        return $this;
    }

    public function getPA(): ?TvSeriesWatchProvidersResultsPA
    {
        return $this->PA;
    }

    public function setPA(?TvSeriesWatchProvidersResultsPA $PA): self
    {
        $this->PA = $PA;

        return $this;
    }

    public function getPE(): ?TvSeriesWatchProvidersResultsPE
    {
        return $this->PE;
    }

    public function setPE(?TvSeriesWatchProvidersResultsPE $PE): self
    {
        $this->PE = $PE;

        return $this;
    }

    public function getPH(): ?TvSeriesWatchProvidersResultsPH
    {
        return $this->PH;
    }

    public function setPH(?TvSeriesWatchProvidersResultsPH $PH): self
    {
        $this->PH = $PH;

        return $this;
    }

    public function getPL(): ?TvSeriesWatchProvidersResultsPL
    {
        return $this->PL;
    }

    public function setPL(?TvSeriesWatchProvidersResultsPL $PL): self
    {
        $this->PL = $PL;

        return $this;
    }

    public function getPS(): ?TvSeriesWatchProvidersResultsPS
    {
        return $this->PS;
    }

    public function setPS(?TvSeriesWatchProvidersResultsPS $PS): self
    {
        $this->PS = $PS;

        return $this;
    }

    public function getPT(): ?TvSeriesWatchProvidersResultsPT
    {
        return $this->PT;
    }

    public function setPT(?TvSeriesWatchProvidersResultsPT $PT): self
    {
        $this->PT = $PT;

        return $this;
    }

    public function getPY(): ?TvSeriesWatchProvidersResultsPY
    {
        return $this->PY;
    }

    public function setPY(?TvSeriesWatchProvidersResultsPY $PY): self
    {
        $this->PY = $PY;

        return $this;
    }

    public function getRO(): ?TvSeriesWatchProvidersResultsRO
    {
        return $this->RO;
    }

    public function setRO(?TvSeriesWatchProvidersResultsRO $RO): self
    {
        $this->RO = $RO;

        return $this;
    }

    public function getRS(): ?TvSeriesWatchProvidersResultsRS
    {
        return $this->RS;
    }

    public function setRS(?TvSeriesWatchProvidersResultsRS $RS): self
    {
        $this->RS = $RS;

        return $this;
    }

    public function getRU(): ?TvSeriesWatchProvidersResultsRU
    {
        return $this->RU;
    }

    public function setRU(?TvSeriesWatchProvidersResultsRU $RU): self
    {
        $this->RU = $RU;

        return $this;
    }

    public function getSA(): ?TvSeriesWatchProvidersResultsSA
    {
        return $this->SA;
    }

    public function setSA(?TvSeriesWatchProvidersResultsSA $SA): self
    {
        $this->SA = $SA;

        return $this;
    }

    public function getSC(): ?TvSeriesWatchProvidersResultsSC
    {
        return $this->SC;
    }

    public function setSC(?TvSeriesWatchProvidersResultsSC $SC): self
    {
        $this->SC = $SC;

        return $this;
    }

    public function getSE(): ?TvSeriesWatchProvidersResultsSE
    {
        return $this->SE;
    }

    public function setSE(?TvSeriesWatchProvidersResultsSE $SE): self
    {
        $this->SE = $SE;

        return $this;
    }

    public function getSG(): ?TvSeriesWatchProvidersResultsSG
    {
        return $this->SG;
    }

    public function setSG(?TvSeriesWatchProvidersResultsSG $SG): self
    {
        $this->SG = $SG;

        return $this;
    }

    public function getSI(): ?TvSeriesWatchProvidersResultsSI
    {
        return $this->SI;
    }

    public function setSI(?TvSeriesWatchProvidersResultsSI $SI): self
    {
        $this->SI = $SI;

        return $this;
    }

    public function getSK(): ?TvSeriesWatchProvidersResultsSK
    {
        return $this->SK;
    }

    public function setSK(?TvSeriesWatchProvidersResultsSK $SK): self
    {
        $this->SK = $SK;

        return $this;
    }

    public function getSN(): ?TvSeriesWatchProvidersResultsSN
    {
        return $this->SN;
    }

    public function setSN(?TvSeriesWatchProvidersResultsSN $SN): self
    {
        $this->SN = $SN;

        return $this;
    }

    public function getSV(): ?TvSeriesWatchProvidersResultsSV
    {
        return $this->SV;
    }

    public function setSV(?TvSeriesWatchProvidersResultsSV $SV): self
    {
        $this->SV = $SV;

        return $this;
    }

    public function getTH(): ?TvSeriesWatchProvidersResultsTH
    {
        return $this->TH;
    }

    public function setTH(?TvSeriesWatchProvidersResultsTH $TH): self
    {
        $this->TH = $TH;

        return $this;
    }

    public function getTR(): ?TvSeriesWatchProvidersResultsTR
    {
        return $this->TR;
    }

    public function setTR(?TvSeriesWatchProvidersResultsTR $TR): self
    {
        $this->TR = $TR;

        return $this;
    }

    public function getTT(): ?TvSeriesWatchProvidersResultsTT
    {
        return $this->TT;
    }

    public function setTT(?TvSeriesWatchProvidersResultsTT $TT): self
    {
        $this->TT = $TT;

        return $this;
    }

    public function getTW(): ?TvSeriesWatchProvidersResultsTW
    {
        return $this->TW;
    }

    public function setTW(?TvSeriesWatchProvidersResultsTW $TW): self
    {
        $this->TW = $TW;

        return $this;
    }

    public function getTZ(): ?TvSeriesWatchProvidersResultsTZ
    {
        return $this->TZ;
    }

    public function setTZ(?TvSeriesWatchProvidersResultsTZ $TZ): self
    {
        $this->TZ = $TZ;

        return $this;
    }

    public function getUG(): ?TvSeriesWatchProvidersResultsUG
    {
        return $this->UG;
    }

    public function setUG(?TvSeriesWatchProvidersResultsUG $UG): self
    {
        $this->UG = $UG;

        return $this;
    }

    public function getUS(): ?TvSeriesWatchProvidersResultsUS
    {
        return $this->US;
    }

    public function setUS(?TvSeriesWatchProvidersResultsUS $US): self
    {
        $this->US = $US;

        return $this;
    }

    public function getUY(): ?TvSeriesWatchProvidersResultsUY
    {
        return $this->UY;
    }

    public function setUY(?TvSeriesWatchProvidersResultsUY $UY): self
    {
        $this->UY = $UY;

        return $this;
    }

    public function getVE(): ?TvSeriesWatchProvidersResultsVE
    {
        return $this->VE;
    }

    public function setVE(?TvSeriesWatchProvidersResultsVE $VE): self
    {
        $this->VE = $VE;

        return $this;
    }

    public function getZA(): ?TvSeriesWatchProvidersResultsZA
    {
        return $this->ZA;
    }

    public function setZA(?TvSeriesWatchProvidersResultsZA $ZA): self
    {
        $this->ZA = $ZA;

        return $this;
    }

    public function getZM(): ?TvSeriesWatchProvidersResultsZM
    {
        return $this->ZM;
    }

    public function setZM(?TvSeriesWatchProvidersResultsZM $ZM): self
    {
        $this->ZM = $ZM;

        return $this;
    }
}