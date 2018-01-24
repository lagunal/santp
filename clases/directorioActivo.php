<?php
class directorioActivo {
    public $nomina = "pdvsacom-ad-payrollclass";
    public $email = "mail";
    public $id = "uid";
    public $area = "pdvsacom-ad-area";
    public $telefono = "ipphone";
    public $compania = "company";
    public $nombre = "displayname";
    public $organization = "pdvsacom-ad-organization";
    public $localidad = "pdvsacom-ad-physicallocality";
    public $cedula = "pdvsacom-ad-cedula";
    public $oficina = "physicaldeliveryofficename";
    public $supervisor = "pdvsacom-ad-functionalsupervisor";
    public $cargo = "title";
    public $celular = "mobile";
    public $nacionalidad = "pdvsacom-ad-nationid";
    public $tipoempleado = "employeetype";
    public $primernombre = "givenname";
    public $segundonombre = "middlename";
    public $apellido = "sn";
    public $nombrered = "name";
    public $fechaingreso = "pdvsacom-ad-hiredate";
    public $fechaegreso = "pdvsacom-ad-firedate";
    public $numeroempleado = "employeeid";
    private $criterioBusqueda = "(|(UserAccountControl=512)(UserAccountControl=66048)(UserAccountControl=544)(UserAccountControl=66080))";
    private $baseDN;
    private $ldapSrv;
    private $dominio;
    private $codigo;
    
    function directorioActivo( $codigo ){
	$this->codigo = $codigo;

	switch( $codigo ){
		case 1:
			$this->ldapSrv = "ldap://CCSCAM17.pdvsa.com";
			$this->baseDN = "OU=Usuarios, DC=pdvsa, DC=com";
			$this->dominio = "@pdvsa.com";
		break;
		case 2:
			$this->ldapSrv = "ldap://PDV-SRV-02.psi.pdv.com";
			$this->baseDN = "DC=psi,DC=pdv,DC=com";
			$this->dominio = "@psi.pdv.com";
		break;
		case 3:
			$this->ldapSrv = "ldap://pqvmordc01.pdvsa.com";
			$this->baseDN = "DC=pequiven,DC=com";
			$this->dominio = "@pequiven.com";
		break;
	}
    }

    private function conectar(){
	return @ldap_connect($this->ldapSrv, "389");
    }

    private function obtenerResultados($datos){
        $c = count($datos) - 1;
        $res = array();
        
        for($i = 0; $i < $c; $i++)
            $res[] = @array($this->id => $datos[$i][$this->id][0], $this->fechaingreso => $datos[$i][$this->fechaingreso][0]);
        
        return $res;
    }

    public function validarCuenta( $usuario, $clave ){
        $con = $this->conectar();

	ldap_set_option( $con, LDAP_OPT_PROTOCOL_VERSION, 3 );
	ldap_set_option( $con, LDAP_OPT_REFERRALS,0 );
        
        if( $con )
            if( trim( $usuario )!="" AND trim( $clave )!="" ) {
		if( @ldap_bind( $con, trim( $usuario ) . $this->dominio, trim( $clave ) ) ) {
                    ldap_unbind( $con );
                    return true;
                }
            }

        return false;
    }

    public function obtenerUsuariosID($usuario){
        $nombres = split(" ", $usuario);
        $c = count($nombres);
        $criterio = "(&";
        
        for($i = 0; $i  < $c; $i ++)
            $criterio .= "(displayname=*$nombres[$i]*)";
        
        $criterio .= ")";
         
        $con = $this->conectar();

	ldap_set_option( $con, LDAP_OPT_PROTOCOL_VERSION, 3 );
	ldap_set_option( $con, LDAP_OPT_REFERRALS,0 );

        $res = ldap_search($con, $this->baseDN, "(&$this->criterioBusqueda(|(sAMAccountName=$usuario*)$criterio))");
        $info = ldap_get_entries($con, $res);
        
        return $this->obtenerResultados($info);
    }

    public function obtenerUsuarioID( $id, $usuario, $clave ) {
        //$criterio = "(&$this->criterioBusqueda(|";
        $criterio .= "sAMAccountName=$id";
        //$criterio .= "))";

        $con = $this->conectar();

	ldap_set_option( $con, LDAP_OPT_PROTOCOL_VERSION, 3 );
	ldap_set_option( $con, LDAP_OPT_REFERRALS,0 );

	if( @ldap_bind( $con, trim( $usuario ) . $this->dominio, trim( $clave ) ) ) {
        	$res = @ldap_search( $con, $this->baseDN, $criterio );
        	$info = @ldap_get_entries($con, $res);
	}
        
        return $info;
    }
    
    public function obtenerValor( $id, $campos, $usuario, $clave ) {
        $con = $this->conectar();
	$val = array();

	ldap_set_option( $con, LDAP_OPT_PROTOCOL_VERSION, 3 );
	ldap_set_option( $con, LDAP_OPT_REFERRALS,0 );

	if( @ldap_bind( $con, trim( $usuario ) . $this->dominio, trim( $clave ) ) ) {
	$res = @ldap_search( $con, $this->baseDN, "sAMAccountName=" . $id );

	$info = @ldap_get_entries($con, $res);

	if(isset($campos) && $campos!=""){
		for($i = 0; $i < count($campos); $i++)
			$val[] = @$info[0][$campos[$i]][0];
		}else{
			$val = $info[0];
		}
	}

        return $val;
    }
}
?>
