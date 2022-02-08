// PHRSHARE.sol
// Smart Contract for a patient to share a PHR with a HCP

pragma solidity >=0.7.0 <0.9.0;
contract PHRSHARE{
    // hash of phr, DB index, patient public key, and patient Name
    struct patientHCPPHR{
        string phrHash;
        uint phrDBIndex;
        string patientPublicKey;
        string patientName;
    }

    mapping(string => patientHCPPHR) patientHCPPHRs;

    constructor() {}

    // set values based on HCP public key
    function setPHR(string memory _publicKey, string memory _phrHash, uint _phrDBIndex, string memory _publicKey1, string memory _patientName) public{
        patientHCPPHRs[_publicKey].phrHash = _phrHash;
        patientHCPPHRs[_publicKey].phrDBIndex = _phrDBIndex;
        patientHCPPHRs[_publicKey].patientPublicKey = _publicKey1;
        patientHCPPHRs[_publicKey].patientName = _patientName;
    }

    // get values
    function getPatientPHR(string memory _publicKey) public view returns(string memory phrHash){
        return patientHCPPHRs[_publicKey].phrHash;
    }

    function getPatientDBIndex(string memory _publicKey) view public returns(uint dbIndex){
        return patientHCPPHRs[_publicKey].phrDBIndex;
    }

    function getPatientPublicKey(string memory _publicKey) view public returns(string memory patientPublicKey){
        return patientHCPPHRs[_publicKey].patientPublicKey;
    }

    function getPatientName(string memory _publicKey) view public returns(string memory patientName){
        return patientHCPPHRs[_publicKey].patientName;
    }
}