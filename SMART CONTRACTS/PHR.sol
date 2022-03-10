// PHR.sol
// Smart Contract to store a patient's PHR

pragma solidity >=0.7.0 <0.9.0;
contract PHR{
    // hash of PHR and DB index
    struct patientPHR{
        string phrHash;
        uint phrDBIndex;
    }

    mapping(string => patientPHR) patientPHRs;

    constructor() {}

    // set values based on patient public key
    function setPHR(string memory _publicKey, string memory _phrHash, uint _phrDBIndex) public{
        patientPHRs[_publicKey].phrHash = _phrHash;
        patientPHRs[_publicKey].phrDBIndex = _phrDBIndex;
    }

    // get values
    function getPatientPHR(string memory _publicKey) public view returns (string memory phrHash){
        return patientPHRs[_publicKey].phrHash;
    }

    function getPatientDBIndex(string memory _publicKey) public view returns (uint dbIndex){
        return patientPHRs[_publicKey].phrDBIndex;
    }
}
