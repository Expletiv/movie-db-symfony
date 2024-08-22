<?php

namespace App\Dto\Tmdb\Responses\Movie;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class MovieWatchProvidersResults
{
    #[SerializedName('AE')]
    private ?MovieWatchProvidersResultsAE $AE = null;
    #[SerializedName('AL')]
    private ?MovieWatchProvidersResultsAL $AL = null;
    #[SerializedName('AR')]
    private ?MovieWatchProvidersResultsAR $AR = null;
    #[SerializedName('AT')]
    private ?MovieWatchProvidersResultsAT $AT = null;
    #[SerializedName('AU')]
    private ?MovieWatchProvidersResultsAU $AU = null;
    #[SerializedName('BA')]
    private ?MovieWatchProvidersResultsBA $BA = null;
    #[SerializedName('BB')]
    private ?MovieWatchProvidersResultsBB $BB = null;
    #[SerializedName('BE')]
    private ?MovieWatchProvidersResultsBE $BE = null;
    #[SerializedName('BG')]
    private ?MovieWatchProvidersResultsBG $BG = null;
    #[SerializedName('BH')]
    private ?MovieWatchProvidersResultsBH $BH = null;
    #[SerializedName('BO')]
    private ?MovieWatchProvidersResultsBO $BO = null;
    #[SerializedName('BR')]
    private ?MovieWatchProvidersResultsBR $BR = null;
    #[SerializedName('BS')]
    private ?MovieWatchProvidersResultsBS $BS = null;
    #[SerializedName('CA')]
    private ?MovieWatchProvidersResultsCA $CA = null;
    #[SerializedName('CH')]
    private ?MovieWatchProvidersResultsCH $CH = null;
    #[SerializedName('CL')]
    private ?MovieWatchProvidersResultsCL $CL = null;
    #[SerializedName('CO')]
    private ?MovieWatchProvidersResultsCO $CO = null;
    #[SerializedName('CR')]
    private ?MovieWatchProvidersResultsCR $CR = null;
    #[SerializedName('CV')]
    private ?MovieWatchProvidersResultsCV $CV = null;
    #[SerializedName('CZ')]
    private ?MovieWatchProvidersResultsCZ $CZ = null;
    #[SerializedName('DE')]
    private ?MovieWatchProvidersResultsDE $DE = null;
    #[SerializedName('DK')]
    private ?MovieWatchProvidersResultsDK $DK = null;
    #[SerializedName('DO')]
    private ?MovieWatchProvidersResultsDO $DO = null;
    #[SerializedName('EC')]
    private ?MovieWatchProvidersResultsEC $EC = null;
    #[SerializedName('EE')]
    private ?MovieWatchProvidersResultsEE $EE = null;
    #[SerializedName('EG')]
    private ?MovieWatchProvidersResultsEG $EG = null;
    #[SerializedName('ES')]
    private ?MovieWatchProvidersResultsES $ES = null;
    #[SerializedName('FI')]
    private ?MovieWatchProvidersResultsFI $FI = null;
    #[SerializedName('FJ')]
    private ?MovieWatchProvidersResultsFJ $FJ = null;
    #[SerializedName('FR')]
    private ?MovieWatchProvidersResultsFR $FR = null;
    #[SerializedName('GB')]
    private ?MovieWatchProvidersResultsGB $GB = null;
    #[SerializedName('GF')]
    private ?MovieWatchProvidersResultsGF $GF = null;
    #[SerializedName('GI')]
    private ?MovieWatchProvidersResultsGI $GI = null;
    #[SerializedName('GR')]
    private ?MovieWatchProvidersResultsGR $GR = null;
    #[SerializedName('GT')]
    private ?MovieWatchProvidersResultsGT $GT = null;
    #[SerializedName('HK')]
    private ?MovieWatchProvidersResultsHK $HK = null;
    #[SerializedName('HN')]
    private ?MovieWatchProvidersResultsHN $HN = null;
    #[SerializedName('HR')]
    private ?MovieWatchProvidersResultsHR $HR = null;
    #[SerializedName('HU')]
    private ?MovieWatchProvidersResultsHU $HU = null;
    #[SerializedName('ID')]
    private ?MovieWatchProvidersResultsID $ID = null;
    #[SerializedName('IE')]
    private ?MovieWatchProvidersResultsIE $IE = null;
    #[SerializedName('IL')]
    private ?MovieWatchProvidersResultsIL $IL = null;
    #[SerializedName('IN')]
    private ?MovieWatchProvidersResultsIN $IN = null;
    #[SerializedName('IQ')]
    private ?MovieWatchProvidersResultsIQ $IQ = null;
    #[SerializedName('IS')]
    private ?MovieWatchProvidersResultsIS $IS = null;
    #[SerializedName('IT')]
    private ?MovieWatchProvidersResultsIT $IT = null;
    #[SerializedName('JM')]
    private ?MovieWatchProvidersResultsJM $JM = null;
    #[SerializedName('JO')]
    private ?MovieWatchProvidersResultsJO $JO = null;
    #[SerializedName('JP')]
    private ?MovieWatchProvidersResultsJP $JP = null;
    #[SerializedName('KR')]
    private ?MovieWatchProvidersResultsKR $KR = null;
    #[SerializedName('KW')]
    private ?MovieWatchProvidersResultsKW $KW = null;
    #[SerializedName('LB')]
    private ?MovieWatchProvidersResultsLB $LB = null;
    #[SerializedName('LI')]
    private ?MovieWatchProvidersResultsLI $LI = null;
    #[SerializedName('LT')]
    private ?MovieWatchProvidersResultsLT $LT = null;
    #[SerializedName('LV')]
    private ?MovieWatchProvidersResultsLV $LV = null;
    #[SerializedName('MD')]
    private ?MovieWatchProvidersResultsMD $MD = null;
    #[SerializedName('MK')]
    private ?MovieWatchProvidersResultsMK $MK = null;
    #[SerializedName('MT')]
    private ?MovieWatchProvidersResultsMT $MT = null;
    #[SerializedName('MU')]
    private ?MovieWatchProvidersResultsMU $MU = null;
    #[SerializedName('MX')]
    private ?MovieWatchProvidersResultsMX $MX = null;
    #[SerializedName('MY')]
    private ?MovieWatchProvidersResultsMY $MY = null;
    #[SerializedName('MZ')]
    private ?MovieWatchProvidersResultsMZ $MZ = null;
    #[SerializedName('NL')]
    private ?MovieWatchProvidersResultsNL $NL = null;
    #[SerializedName('NO')]
    private ?MovieWatchProvidersResultsNO $NO = null;
    #[SerializedName('NZ')]
    private ?MovieWatchProvidersResultsNZ $NZ = null;
    #[SerializedName('OM')]
    private ?MovieWatchProvidersResultsOM $OM = null;
    #[SerializedName('PA')]
    private ?MovieWatchProvidersResultsPA $PA = null;
    #[SerializedName('PE')]
    private ?MovieWatchProvidersResultsPE $PE = null;
    #[SerializedName('PH')]
    private ?MovieWatchProvidersResultsPH $PH = null;
    #[SerializedName('PK')]
    private ?MovieWatchProvidersResultsPK $PK = null;
    #[SerializedName('PL')]
    private ?MovieWatchProvidersResultsPL $PL = null;
    #[SerializedName('PS')]
    private ?MovieWatchProvidersResultsPS $PS = null;
    #[SerializedName('PT')]
    private ?MovieWatchProvidersResultsPT $PT = null;
    #[SerializedName('PY')]
    private ?MovieWatchProvidersResultsPY $PY = null;
    #[SerializedName('QA')]
    private ?MovieWatchProvidersResultsQA $QA = null;
    #[SerializedName('RO')]
    private ?MovieWatchProvidersResultsRO $RO = null;
    #[SerializedName('RS')]
    private ?MovieWatchProvidersResultsRS $RS = null;
    #[SerializedName('RU')]
    private ?MovieWatchProvidersResultsRU $RU = null;
    #[SerializedName('SA')]
    private ?MovieWatchProvidersResultsSA $SA = null;
    #[SerializedName('SE')]
    private ?MovieWatchProvidersResultsSE $SE = null;
    #[SerializedName('SG')]
    private ?MovieWatchProvidersResultsSG $SG = null;
    #[SerializedName('SI')]
    private ?MovieWatchProvidersResultsSI $SI = null;
    #[SerializedName('SK')]
    private ?MovieWatchProvidersResultsSK $SK = null;
    #[SerializedName('SM')]
    private ?MovieWatchProvidersResultsSM $SM = null;
    #[SerializedName('SV')]
    private ?MovieWatchProvidersResultsSV $SV = null;
    #[SerializedName('TH')]
    private ?MovieWatchProvidersResultsTH $TH = null;
    #[SerializedName('TR')]
    private ?MovieWatchProvidersResultsTR $TR = null;
    #[SerializedName('TT')]
    private ?MovieWatchProvidersResultsTT $TT = null;
    #[SerializedName('TW')]
    private ?MovieWatchProvidersResultsTW $TW = null;
    #[SerializedName('UG')]
    private ?MovieWatchProvidersResultsUG $UG = null;
    #[SerializedName('US')]
    private ?MovieWatchProvidersResultsUS $US = null;
    #[SerializedName('UY')]
    private ?MovieWatchProvidersResultsUY $UY = null;
    #[SerializedName('VE')]
    private ?MovieWatchProvidersResultsVE $VE = null;
    #[SerializedName('YE')]
    private ?MovieWatchProvidersResultsYE $YE = null;
    #[SerializedName('ZA')]
    private ?MovieWatchProvidersResultsZA $ZA = null;

    public static function fromArray(array $data = []): self
    {
        $serializer = new Serializer([new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter()), new ArrayDenormalizer()]);
        return $serializer->denormalize($data, self::class);
    }

    public function toArray(): array
    {
        $serializer = new Serializer([new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter()), new ArrayDenormalizer()]);
        return $serializer->normalize($this);
    }

    public function getAE(): ?MovieWatchProvidersResultsAE
    {
        return $this->AE;
    }

    public function setAE(?MovieWatchProvidersResultsAE $AE): self
    {
        $this->AE = $AE;

        return $this;
    }

    public function getAL(): ?MovieWatchProvidersResultsAL
    {
        return $this->AL;
    }

    public function setAL(?MovieWatchProvidersResultsAL $AL): self
    {
        $this->AL = $AL;

        return $this;
    }

    public function getAR(): ?MovieWatchProvidersResultsAR
    {
        return $this->AR;
    }

    public function setAR(?MovieWatchProvidersResultsAR $AR): self
    {
        $this->AR = $AR;

        return $this;
    }

    public function getAT(): ?MovieWatchProvidersResultsAT
    {
        return $this->AT;
    }

    public function setAT(?MovieWatchProvidersResultsAT $AT): self
    {
        $this->AT = $AT;

        return $this;
    }

    public function getAU(): ?MovieWatchProvidersResultsAU
    {
        return $this->AU;
    }

    public function setAU(?MovieWatchProvidersResultsAU $AU): self
    {
        $this->AU = $AU;

        return $this;
    }

    public function getBA(): ?MovieWatchProvidersResultsBA
    {
        return $this->BA;
    }

    public function setBA(?MovieWatchProvidersResultsBA $BA): self
    {
        $this->BA = $BA;

        return $this;
    }

    public function getBB(): ?MovieWatchProvidersResultsBB
    {
        return $this->BB;
    }

    public function setBB(?MovieWatchProvidersResultsBB $BB): self
    {
        $this->BB = $BB;

        return $this;
    }

    public function getBE(): ?MovieWatchProvidersResultsBE
    {
        return $this->BE;
    }

    public function setBE(?MovieWatchProvidersResultsBE $BE): self
    {
        $this->BE = $BE;

        return $this;
    }

    public function getBG(): ?MovieWatchProvidersResultsBG
    {
        return $this->BG;
    }

    public function setBG(?MovieWatchProvidersResultsBG $BG): self
    {
        $this->BG = $BG;

        return $this;
    }

    public function getBH(): ?MovieWatchProvidersResultsBH
    {
        return $this->BH;
    }

    public function setBH(?MovieWatchProvidersResultsBH $BH): self
    {
        $this->BH = $BH;

        return $this;
    }

    public function getBO(): ?MovieWatchProvidersResultsBO
    {
        return $this->BO;
    }

    public function setBO(?MovieWatchProvidersResultsBO $BO): self
    {
        $this->BO = $BO;

        return $this;
    }

    public function getBR(): ?MovieWatchProvidersResultsBR
    {
        return $this->BR;
    }

    public function setBR(?MovieWatchProvidersResultsBR $BR): self
    {
        $this->BR = $BR;

        return $this;
    }

    public function getBS(): ?MovieWatchProvidersResultsBS
    {
        return $this->BS;
    }

    public function setBS(?MovieWatchProvidersResultsBS $BS): self
    {
        $this->BS = $BS;

        return $this;
    }

    public function getCA(): ?MovieWatchProvidersResultsCA
    {
        return $this->CA;
    }

    public function setCA(?MovieWatchProvidersResultsCA $CA): self
    {
        $this->CA = $CA;

        return $this;
    }

    public function getCH(): ?MovieWatchProvidersResultsCH
    {
        return $this->CH;
    }

    public function setCH(?MovieWatchProvidersResultsCH $CH): self
    {
        $this->CH = $CH;

        return $this;
    }

    public function getCL(): ?MovieWatchProvidersResultsCL
    {
        return $this->CL;
    }

    public function setCL(?MovieWatchProvidersResultsCL $CL): self
    {
        $this->CL = $CL;

        return $this;
    }

    public function getCO(): ?MovieWatchProvidersResultsCO
    {
        return $this->CO;
    }

    public function setCO(?MovieWatchProvidersResultsCO $CO): self
    {
        $this->CO = $CO;

        return $this;
    }

    public function getCR(): ?MovieWatchProvidersResultsCR
    {
        return $this->CR;
    }

    public function setCR(?MovieWatchProvidersResultsCR $CR): self
    {
        $this->CR = $CR;

        return $this;
    }

    public function getCV(): ?MovieWatchProvidersResultsCV
    {
        return $this->CV;
    }

    public function setCV(?MovieWatchProvidersResultsCV $CV): self
    {
        $this->CV = $CV;

        return $this;
    }

    public function getCZ(): ?MovieWatchProvidersResultsCZ
    {
        return $this->CZ;
    }

    public function setCZ(?MovieWatchProvidersResultsCZ $CZ): self
    {
        $this->CZ = $CZ;

        return $this;
    }

    public function getDE(): ?MovieWatchProvidersResultsDE
    {
        return $this->DE;
    }

    public function setDE(?MovieWatchProvidersResultsDE $DE): self
    {
        $this->DE = $DE;

        return $this;
    }

    public function getDK(): ?MovieWatchProvidersResultsDK
    {
        return $this->DK;
    }

    public function setDK(?MovieWatchProvidersResultsDK $DK): self
    {
        $this->DK = $DK;

        return $this;
    }

    public function getDO(): ?MovieWatchProvidersResultsDO
    {
        return $this->DO;
    }

    public function setDO(?MovieWatchProvidersResultsDO $DO): self
    {
        $this->DO = $DO;

        return $this;
    }

    public function getEC(): ?MovieWatchProvidersResultsEC
    {
        return $this->EC;
    }

    public function setEC(?MovieWatchProvidersResultsEC $EC): self
    {
        $this->EC = $EC;

        return $this;
    }

    public function getEE(): ?MovieWatchProvidersResultsEE
    {
        return $this->EE;
    }

    public function setEE(?MovieWatchProvidersResultsEE $EE): self
    {
        $this->EE = $EE;

        return $this;
    }

    public function getEG(): ?MovieWatchProvidersResultsEG
    {
        return $this->EG;
    }

    public function setEG(?MovieWatchProvidersResultsEG $EG): self
    {
        $this->EG = $EG;

        return $this;
    }

    public function getES(): ?MovieWatchProvidersResultsES
    {
        return $this->ES;
    }

    public function setES(?MovieWatchProvidersResultsES $ES): self
    {
        $this->ES = $ES;

        return $this;
    }

    public function getFI(): ?MovieWatchProvidersResultsFI
    {
        return $this->FI;
    }

    public function setFI(?MovieWatchProvidersResultsFI $FI): self
    {
        $this->FI = $FI;

        return $this;
    }

    public function getFJ(): ?MovieWatchProvidersResultsFJ
    {
        return $this->FJ;
    }

    public function setFJ(?MovieWatchProvidersResultsFJ $FJ): self
    {
        $this->FJ = $FJ;

        return $this;
    }

    public function getFR(): ?MovieWatchProvidersResultsFR
    {
        return $this->FR;
    }

    public function setFR(?MovieWatchProvidersResultsFR $FR): self
    {
        $this->FR = $FR;

        return $this;
    }

    public function getGB(): ?MovieWatchProvidersResultsGB
    {
        return $this->GB;
    }

    public function setGB(?MovieWatchProvidersResultsGB $GB): self
    {
        $this->GB = $GB;

        return $this;
    }

    public function getGF(): ?MovieWatchProvidersResultsGF
    {
        return $this->GF;
    }

    public function setGF(?MovieWatchProvidersResultsGF $GF): self
    {
        $this->GF = $GF;

        return $this;
    }

    public function getGI(): ?MovieWatchProvidersResultsGI
    {
        return $this->GI;
    }

    public function setGI(?MovieWatchProvidersResultsGI $GI): self
    {
        $this->GI = $GI;

        return $this;
    }

    public function getGR(): ?MovieWatchProvidersResultsGR
    {
        return $this->GR;
    }

    public function setGR(?MovieWatchProvidersResultsGR $GR): self
    {
        $this->GR = $GR;

        return $this;
    }

    public function getGT(): ?MovieWatchProvidersResultsGT
    {
        return $this->GT;
    }

    public function setGT(?MovieWatchProvidersResultsGT $GT): self
    {
        $this->GT = $GT;

        return $this;
    }

    public function getHK(): ?MovieWatchProvidersResultsHK
    {
        return $this->HK;
    }

    public function setHK(?MovieWatchProvidersResultsHK $HK): self
    {
        $this->HK = $HK;

        return $this;
    }

    public function getHN(): ?MovieWatchProvidersResultsHN
    {
        return $this->HN;
    }

    public function setHN(?MovieWatchProvidersResultsHN $HN): self
    {
        $this->HN = $HN;

        return $this;
    }

    public function getHR(): ?MovieWatchProvidersResultsHR
    {
        return $this->HR;
    }

    public function setHR(?MovieWatchProvidersResultsHR $HR): self
    {
        $this->HR = $HR;

        return $this;
    }

    public function getHU(): ?MovieWatchProvidersResultsHU
    {
        return $this->HU;
    }

    public function setHU(?MovieWatchProvidersResultsHU $HU): self
    {
        $this->HU = $HU;

        return $this;
    }

    public function getID(): ?MovieWatchProvidersResultsID
    {
        return $this->ID;
    }

    public function setID(?MovieWatchProvidersResultsID $ID): self
    {
        $this->ID = $ID;

        return $this;
    }

    public function getIE(): ?MovieWatchProvidersResultsIE
    {
        return $this->IE;
    }

    public function setIE(?MovieWatchProvidersResultsIE $IE): self
    {
        $this->IE = $IE;

        return $this;
    }

    public function getIL(): ?MovieWatchProvidersResultsIL
    {
        return $this->IL;
    }

    public function setIL(?MovieWatchProvidersResultsIL $IL): self
    {
        $this->IL = $IL;

        return $this;
    }

    public function getIN(): ?MovieWatchProvidersResultsIN
    {
        return $this->IN;
    }

    public function setIN(?MovieWatchProvidersResultsIN $IN): self
    {
        $this->IN = $IN;

        return $this;
    }

    public function getIQ(): ?MovieWatchProvidersResultsIQ
    {
        return $this->IQ;
    }

    public function setIQ(?MovieWatchProvidersResultsIQ $IQ): self
    {
        $this->IQ = $IQ;

        return $this;
    }

    public function getIS(): ?MovieWatchProvidersResultsIS
    {
        return $this->IS;
    }

    public function setIS(?MovieWatchProvidersResultsIS $IS): self
    {
        $this->IS = $IS;

        return $this;
    }

    public function getIT(): ?MovieWatchProvidersResultsIT
    {
        return $this->IT;
    }

    public function setIT(?MovieWatchProvidersResultsIT $IT): self
    {
        $this->IT = $IT;

        return $this;
    }

    public function getJM(): ?MovieWatchProvidersResultsJM
    {
        return $this->JM;
    }

    public function setJM(?MovieWatchProvidersResultsJM $JM): self
    {
        $this->JM = $JM;

        return $this;
    }

    public function getJO(): ?MovieWatchProvidersResultsJO
    {
        return $this->JO;
    }

    public function setJO(?MovieWatchProvidersResultsJO $JO): self
    {
        $this->JO = $JO;

        return $this;
    }

    public function getJP(): ?MovieWatchProvidersResultsJP
    {
        return $this->JP;
    }

    public function setJP(?MovieWatchProvidersResultsJP $JP): self
    {
        $this->JP = $JP;

        return $this;
    }

    public function getKR(): ?MovieWatchProvidersResultsKR
    {
        return $this->KR;
    }

    public function setKR(?MovieWatchProvidersResultsKR $KR): self
    {
        $this->KR = $KR;

        return $this;
    }

    public function getKW(): ?MovieWatchProvidersResultsKW
    {
        return $this->KW;
    }

    public function setKW(?MovieWatchProvidersResultsKW $KW): self
    {
        $this->KW = $KW;

        return $this;
    }

    public function getLB(): ?MovieWatchProvidersResultsLB
    {
        return $this->LB;
    }

    public function setLB(?MovieWatchProvidersResultsLB $LB): self
    {
        $this->LB = $LB;

        return $this;
    }

    public function getLI(): ?MovieWatchProvidersResultsLI
    {
        return $this->LI;
    }

    public function setLI(?MovieWatchProvidersResultsLI $LI): self
    {
        $this->LI = $LI;

        return $this;
    }

    public function getLT(): ?MovieWatchProvidersResultsLT
    {
        return $this->LT;
    }

    public function setLT(?MovieWatchProvidersResultsLT $LT): self
    {
        $this->LT = $LT;

        return $this;
    }

    public function getLV(): ?MovieWatchProvidersResultsLV
    {
        return $this->LV;
    }

    public function setLV(?MovieWatchProvidersResultsLV $LV): self
    {
        $this->LV = $LV;

        return $this;
    }

    public function getMD(): ?MovieWatchProvidersResultsMD
    {
        return $this->MD;
    }

    public function setMD(?MovieWatchProvidersResultsMD $MD): self
    {
        $this->MD = $MD;

        return $this;
    }

    public function getMK(): ?MovieWatchProvidersResultsMK
    {
        return $this->MK;
    }

    public function setMK(?MovieWatchProvidersResultsMK $MK): self
    {
        $this->MK = $MK;

        return $this;
    }

    public function getMT(): ?MovieWatchProvidersResultsMT
    {
        return $this->MT;
    }

    public function setMT(?MovieWatchProvidersResultsMT $MT): self
    {
        $this->MT = $MT;

        return $this;
    }

    public function getMU(): ?MovieWatchProvidersResultsMU
    {
        return $this->MU;
    }

    public function setMU(?MovieWatchProvidersResultsMU $MU): self
    {
        $this->MU = $MU;

        return $this;
    }

    public function getMX(): ?MovieWatchProvidersResultsMX
    {
        return $this->MX;
    }

    public function setMX(?MovieWatchProvidersResultsMX $MX): self
    {
        $this->MX = $MX;

        return $this;
    }

    public function getMY(): ?MovieWatchProvidersResultsMY
    {
        return $this->MY;
    }

    public function setMY(?MovieWatchProvidersResultsMY $MY): self
    {
        $this->MY = $MY;

        return $this;
    }

    public function getMZ(): ?MovieWatchProvidersResultsMZ
    {
        return $this->MZ;
    }

    public function setMZ(?MovieWatchProvidersResultsMZ $MZ): self
    {
        $this->MZ = $MZ;

        return $this;
    }

    public function getNL(): ?MovieWatchProvidersResultsNL
    {
        return $this->NL;
    }

    public function setNL(?MovieWatchProvidersResultsNL $NL): self
    {
        $this->NL = $NL;

        return $this;
    }

    public function getNO(): ?MovieWatchProvidersResultsNO
    {
        return $this->NO;
    }

    public function setNO(?MovieWatchProvidersResultsNO $NO): self
    {
        $this->NO = $NO;

        return $this;
    }

    public function getNZ(): ?MovieWatchProvidersResultsNZ
    {
        return $this->NZ;
    }

    public function setNZ(?MovieWatchProvidersResultsNZ $NZ): self
    {
        $this->NZ = $NZ;

        return $this;
    }

    public function getOM(): ?MovieWatchProvidersResultsOM
    {
        return $this->OM;
    }

    public function setOM(?MovieWatchProvidersResultsOM $OM): self
    {
        $this->OM = $OM;

        return $this;
    }

    public function getPA(): ?MovieWatchProvidersResultsPA
    {
        return $this->PA;
    }

    public function setPA(?MovieWatchProvidersResultsPA $PA): self
    {
        $this->PA = $PA;

        return $this;
    }

    public function getPE(): ?MovieWatchProvidersResultsPE
    {
        return $this->PE;
    }

    public function setPE(?MovieWatchProvidersResultsPE $PE): self
    {
        $this->PE = $PE;

        return $this;
    }

    public function getPH(): ?MovieWatchProvidersResultsPH
    {
        return $this->PH;
    }

    public function setPH(?MovieWatchProvidersResultsPH $PH): self
    {
        $this->PH = $PH;

        return $this;
    }

    public function getPK(): ?MovieWatchProvidersResultsPK
    {
        return $this->PK;
    }

    public function setPK(?MovieWatchProvidersResultsPK $PK): self
    {
        $this->PK = $PK;

        return $this;
    }

    public function getPL(): ?MovieWatchProvidersResultsPL
    {
        return $this->PL;
    }

    public function setPL(?MovieWatchProvidersResultsPL $PL): self
    {
        $this->PL = $PL;

        return $this;
    }

    public function getPS(): ?MovieWatchProvidersResultsPS
    {
        return $this->PS;
    }

    public function setPS(?MovieWatchProvidersResultsPS $PS): self
    {
        $this->PS = $PS;

        return $this;
    }

    public function getPT(): ?MovieWatchProvidersResultsPT
    {
        return $this->PT;
    }

    public function setPT(?MovieWatchProvidersResultsPT $PT): self
    {
        $this->PT = $PT;

        return $this;
    }

    public function getPY(): ?MovieWatchProvidersResultsPY
    {
        return $this->PY;
    }

    public function setPY(?MovieWatchProvidersResultsPY $PY): self
    {
        $this->PY = $PY;

        return $this;
    }

    public function getQA(): ?MovieWatchProvidersResultsQA
    {
        return $this->QA;
    }

    public function setQA(?MovieWatchProvidersResultsQA $QA): self
    {
        $this->QA = $QA;

        return $this;
    }

    public function getRO(): ?MovieWatchProvidersResultsRO
    {
        return $this->RO;
    }

    public function setRO(?MovieWatchProvidersResultsRO $RO): self
    {
        $this->RO = $RO;

        return $this;
    }

    public function getRS(): ?MovieWatchProvidersResultsRS
    {
        return $this->RS;
    }

    public function setRS(?MovieWatchProvidersResultsRS $RS): self
    {
        $this->RS = $RS;

        return $this;
    }

    public function getRU(): ?MovieWatchProvidersResultsRU
    {
        return $this->RU;
    }

    public function setRU(?MovieWatchProvidersResultsRU $RU): self
    {
        $this->RU = $RU;

        return $this;
    }

    public function getSA(): ?MovieWatchProvidersResultsSA
    {
        return $this->SA;
    }

    public function setSA(?MovieWatchProvidersResultsSA $SA): self
    {
        $this->SA = $SA;

        return $this;
    }

    public function getSE(): ?MovieWatchProvidersResultsSE
    {
        return $this->SE;
    }

    public function setSE(?MovieWatchProvidersResultsSE $SE): self
    {
        $this->SE = $SE;

        return $this;
    }

    public function getSG(): ?MovieWatchProvidersResultsSG
    {
        return $this->SG;
    }

    public function setSG(?MovieWatchProvidersResultsSG $SG): self
    {
        $this->SG = $SG;

        return $this;
    }

    public function getSI(): ?MovieWatchProvidersResultsSI
    {
        return $this->SI;
    }

    public function setSI(?MovieWatchProvidersResultsSI $SI): self
    {
        $this->SI = $SI;

        return $this;
    }

    public function getSK(): ?MovieWatchProvidersResultsSK
    {
        return $this->SK;
    }

    public function setSK(?MovieWatchProvidersResultsSK $SK): self
    {
        $this->SK = $SK;

        return $this;
    }

    public function getSM(): ?MovieWatchProvidersResultsSM
    {
        return $this->SM;
    }

    public function setSM(?MovieWatchProvidersResultsSM $SM): self
    {
        $this->SM = $SM;

        return $this;
    }

    public function getSV(): ?MovieWatchProvidersResultsSV
    {
        return $this->SV;
    }

    public function setSV(?MovieWatchProvidersResultsSV $SV): self
    {
        $this->SV = $SV;

        return $this;
    }

    public function getTH(): ?MovieWatchProvidersResultsTH
    {
        return $this->TH;
    }

    public function setTH(?MovieWatchProvidersResultsTH $TH): self
    {
        $this->TH = $TH;

        return $this;
    }

    public function getTR(): ?MovieWatchProvidersResultsTR
    {
        return $this->TR;
    }

    public function setTR(?MovieWatchProvidersResultsTR $TR): self
    {
        $this->TR = $TR;

        return $this;
    }

    public function getTT(): ?MovieWatchProvidersResultsTT
    {
        return $this->TT;
    }

    public function setTT(?MovieWatchProvidersResultsTT $TT): self
    {
        $this->TT = $TT;

        return $this;
    }

    public function getTW(): ?MovieWatchProvidersResultsTW
    {
        return $this->TW;
    }

    public function setTW(?MovieWatchProvidersResultsTW $TW): self
    {
        $this->TW = $TW;

        return $this;
    }

    public function getUG(): ?MovieWatchProvidersResultsUG
    {
        return $this->UG;
    }

    public function setUG(?MovieWatchProvidersResultsUG $UG): self
    {
        $this->UG = $UG;

        return $this;
    }

    public function getUS(): ?MovieWatchProvidersResultsUS
    {
        return $this->US;
    }

    public function setUS(?MovieWatchProvidersResultsUS $US): self
    {
        $this->US = $US;

        return $this;
    }

    public function getUY(): ?MovieWatchProvidersResultsUY
    {
        return $this->UY;
    }

    public function setUY(?MovieWatchProvidersResultsUY $UY): self
    {
        $this->UY = $UY;

        return $this;
    }

    public function getVE(): ?MovieWatchProvidersResultsVE
    {
        return $this->VE;
    }

    public function setVE(?MovieWatchProvidersResultsVE $VE): self
    {
        $this->VE = $VE;

        return $this;
    }

    public function getYE(): ?MovieWatchProvidersResultsYE
    {
        return $this->YE;
    }

    public function setYE(?MovieWatchProvidersResultsYE $YE): self
    {
        $this->YE = $YE;

        return $this;
    }

    public function getZA(): ?MovieWatchProvidersResultsZA
    {
        return $this->ZA;
    }

    public function setZA(?MovieWatchProvidersResultsZA $ZA): self
    {
        $this->ZA = $ZA;

        return $this;
    }
}