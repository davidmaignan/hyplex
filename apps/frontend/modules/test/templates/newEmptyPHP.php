<form name="indexAptSearch"  action="indexAptSearch.php" method="POST">
    <table width="95%" border="0" cellpadding="0" cellspacing="0" class="tdmi" style="margin:5px">
        <tr>
            <td width="100%">
                <table  border="0" cellpadding="0" cellspacing="0" class="rahmen">
                    <input type="hidden" name="YPS_SID" value="2011052602462406bsqovlclekcluuy">
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="field" value="depApt">
                    <tr class="tdtop">
                        <td height="20"  class="textkopf" style="padding-left:5">
                            <b>area</b>
                        </td>
                        <td height="20" class="textkopf" style="padding-left:5">
                            <b>country</b>
                        </td>
                        <td width="100%" >&nbsp;</td>
                    </tr>
                    <tr class="tdmi">
                        <td  style="padding:3px 3px 3px 3px">
                            <select name="area" size="15"  class="selectbox" onChange="this.form.searchApt.value='';
                                this.form.submit();" style="width:130px; background-color:#F9F9F9;">
                                <option label="Africa" value="AFRI" selected="selected">Africa</option>
                                <option label="Asia" value="ASIA">Asia</option>
                                <option label="Atlantic Ocean" value="ATOC">Atlantic Ocean</option>
                                <option label="Australia" value="AUST">Australia</option>
                                <option label="Caribbean Sea" value="CARI">Caribbean Sea</option>
                                <option label="Central America" value="MIAM">Central America</option>
                                <option label="East Africa" value="EAAF">East Africa</option>
                                <option label="Europe" value="EURO">Europe</option>
                                <option label="Indian Ocean" value="INOC">Indian Ocean</option>
                                <option label="Middle East" value="MIEA">Middle East</option>
                                <option label="North Africa" value="NOAF">North Africa</option>
                                <option label="North America" value="NOAM">North America</option>
                                <option label="Pacific Ocean" value="PAOC">Pacific Ocean</option>
                                <option label="South America" value="SOAM">South America</option>
                                <option label="South Pacific" value="SOPA">South Pacific</option>
                                <option label="Southeast Asia" value="SOEA">Southeast Asia</option>
                                <option label="West Africa" value="WEAF">West Africa</option></select>
                        </td>
                        <td style="padding:3px 3px 3px 3px">
                            <select name="country" size="15" onchange="this.form.searchApt.value='';
                                this.form.submit();" style="width:150px">
                                <option label="Angola" value="AO">Angola</option>
                                <option label="Botswana" value="BW">Botswana</option>
                                <option label="Cameroon" value="CM">Cameroon</option>
                                <option label="Central African Rep." value="CF">Central African Rep.</option>
                                <option label="Chad" value="TD">Chad</option>
                                <option label="Congo-Brazzaville" value="CG">Congo-Brazzaville</option>
                                <option label="Congo-Kinshasa" value="CD">Congo-Kinshasa</option>
                                <option label="Equatorial Guinea" value="GQ">Equatorial Guinea</option>
                                <option label="Gabon" value="GA">Gabon</option>
                                <option label="Lesotho" value="LS">Lesotho</option>
                                <option label="Malawi" value="MW">Malawi</option>
                                <option label="Mozambique" value="MZ">Mozambique</option>
                                <option label="Namibia" value="NA">Namibia</option>
                                <option label="Saint Helena" value="SH">Saint Helena</option>
                                <option label="South Africa" value="ZA">South Africa</option>
                                <option label="Sudan" value="SD">Sudan</option>
                                <option label="Swaziland" value="SZ">Swaziland</option>
                                <option label="São Tomé and Príncipe" value="ST">São Tomé and Príncipe</option>
                                <option label="Zambia" value="ZM">Zambia</option>
                                <option label="Zimbabwe" value="ZW">Zimbabwe</option>
                            </select>
                        </td>
                        <td width="100%" >&nbsp;</td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr class="tdmi">
            <td>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="rahmen tdmi"
                       style="margin-top:2px"><tr class="tdmi">
                        <td height="25" style="padding-left:6px; width:125px">
                            <input  type="text" name="searchApt" id="searchApt" />
                        </td>
                        <td valign="middle">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <img src="#" border="0" align="absmiddle">
                                    </td>
                                    <td>
                                        <a href="#" onclick="document.indexAptSearch.submit();"
                                           class="txtinputdefault textdecoNone ">
                                            <span  class="txtinputdefault">search</span>
                                        </a>
                                    </td>
                                    <td>
                                        <img src="#" border="0" align="absmiddle">
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td align=right valign="middle" style="padding-right:2px">
                            <a href="#" onclick="javascript:if(document.indexAptSearch.city)
                                window.opener.document.MainForm.depApt.value=document.indexAptSearch.city.value;
                                self.close();" style="text-decoration:underline ">
                                <img src="h#" border="0" align="absmiddle">
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>