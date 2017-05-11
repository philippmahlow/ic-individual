{extends file="parent:frontend/checkout/confirm.tpl"}

{block name='frontend_checkout_confirm_submit'}
    {* Submit order button *}
    {if $sPayment.embediframe || $sPayment.action}
        <button type="submit" class="btn is--primary is--large right is--icon-right"
                {if $zedacoDocumentValidationRequired}disabled="disabled"{/if} form="confirm--form"
                data-preloader-button="true">
            {s name='ConfirmDoPayment'}{/s}<i class="icon--arrow-right"></i>
        </button>
    {else}
        <button type="submit" class="btn is--primary is--large right is--icon-right"
                {if $zedacoDocumentValidationRequired}disabled="disabled"{/if} form="confirm--form"
                data-preloader-button="true">
            {s name='ConfirmActionSubmit'}{/s}<i class="icon--arrow-right"></i>
        </button>
    {/if}
{/block}

{block name='frontend_checkout_confirm_tos_panel' append}
    {if $zedacoDocumentValidationRequired}
        <div class="panel">
            <div class="panel--title">{s name="DocumentValidationTitle"}Altersprüfung erforderlich!{/s}</div>
            <div class="panel--body is--wide">
                <p>{s name="DocumentValidationIntro"}Auf Grund gesetzlicher Bestimmungen sind wir dazu verpflichtet vor Bestellabschluss Ihr Alter zu überprüfen. Sollten Sie ein Zedaco-Kundenkonto besitzen, ist diese Überprüfung nur einmalig erforderlich.{/s}</p>


                <div class="perso-check-result" style="display: none;">
                    {include file="frontend/_includes/messages.tpl" type="success" content="{s name="persoCheckResult"}Vielen Dank. Ihr Ausweis wurde erfolgreich verifiziert.{/s}"}
                </div>
                <div class="tab-menu--perso perso-check">
                    <div class="tab--navigation">
                        <a href="#" class="tab--link"
                           data-tabname="perso1">{s name="perso1"}Neuer Personalausweis{/s}</a>
                        <a href="#" class="tab--link"
                           data-tabname="perso2">{s name="perso2"}Alter Personalausweis{/s}</a>
                        <a href="#" class="tab--link"
                           data-tabname="perso3">{s name="perso-passport"}Reisepass{/s}</a>
                        <a href="#" class="tab--link"
                           data-tabname="perso4">{s name="perso-titel"}Aufenthaltstitel{/s}</a>
                    </div>

                    <div class="tab--container-list">
                        <div class="tab--container">
                            <div class="tab--header">
                                <a href="#" class="tab--title"
                                   title="{s name="perso1"}Neuer Personalausweis{/s}">{s name="perso1"}Neuer Personalausweis{/s}</a>
                            </div>
                            <div class="tab--preview">
                                {s name="perso1Preview"}Sie haben einen neuen Personalausweis?{/s}<a href="#"
                                                                                                     class="tab--link"
                                                                                                     title=" mehr"> {s name="moreLink"}Weiter{/s}</a>
                            </div>
                            <div class="tab--content">
                                <div class="buttons--off-canvas">
                                    <a href="#" title="Menü schließen" class="close--off-canvas">
                                        <i class="icon--arrow-left"></i>
                                        {s name="closeMenu"}Menü schließen{/s}
                                    </a>
                                </div>
                                <div class="content--description">
                                    <img class="passport-image"
                                         src="{link file="frontend/_public/src/img/perso_new.png"}"/>
                                    <div class="passport-form" data-documentcheck="true" data-url="{url controller="ZedacoMinorCheck" action="check"}">
                                        <div class="row">
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockA"}Block 1:{/s}</label>
                                                <input type="text" name="persoCheck[blockA]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockB"}Block 2:{/s}</label>
                                                <input type="text" name="persoCheck[blockB]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockC"}Block 3:{/s}</label>
                                                <input type="text" name="persoCheck[blockC]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockD"}Block 4:{/s}</label>
                                                <input type="text" name="persoCheck[blockD]"/>
                                            </div>
                                        </div>
                                        <input type="hidden" name="persoCheck[type]" value="perso-new">
                                        <div class="hint" data-modalbox="true" data-targetselector="a" data-mode="ajax"
                                             data-height="500" data-width="750">
                                            {include file="frontend/_includes/messages.tpl" type="info" content="{s name="passportHint"}Bitte geben Sie Ihre Ausweisnummer ein (Siehe Abbildung). Die Daten werden
                                            ausschließlich zur Überprüfung verwendet und werden weder an Dritte weitergeleitet noch von uns gespeichert.{/s} <a class='btn' href='{url controller="custom" sCustom="46"}'>{s name="passportCheckProblems"}Probleme / Ausländische Dokumente?{/s}</a>"}
                                        </div>
                                        <button  class="submit btn is--primary">{s name="passportCheckSubmit"}Prüfen{/s}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab--container">
                            <div class="tab--header">
                                <a href="#" class="tab--title"
                                   title="{s name="perso2"}{/s}">{s name="perso2"}{/s}</a>
                            </div>
                            <div class="tab--preview">
                                {s name="perso2Preview"}Sie haben einen alten Personalausweis?{/s}<a href="#"
                                                                                                     class="tab--link"
                                                                                                     title=" mehr"> {s name="moreLink"}Weiter{/s}</a>
                            </div>
                            <div class="tab--content">
                                <div class="buttons--off-canvas">
                                    <a href="#" title="Menü schließen" class="close--off-canvas">
                                        <i class="icon--arrow-left"></i>
                                        {s name="closeMenu"}Menü schließen{/s}
                                    </a>
                                </div>
                                <div class="content--description">
                                    <img class="passport-image"
                                         src="{link file="frontend/_public/src/img/perso_old.png"}"/>
                                    <div class="passport-form"  data-documentcheck="true" data-url="{url controller="ZedacoMinorCheck" action="check"}">
                                        <div class="row">
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockA"}Block 1:{/s}</label>
                                                <input type="text" name="persoCheck[blockA]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockB"}Block 2:{/s}</label>
                                                <input type="text" name="persoCheck[blockB]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockC"}Block 3:{/s}</label>
                                                <input type="text" name="persoCheck[blockC]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockD"}Block 4:{/s}</label>
                                                <input type="text" name="persoCheck[blockD]"/>
                                            </div>
                                        </div>
                                        <input type="hidden" name="persoCheck[type]" value="perso-old">
                                        <div class="hint" data-modalbox="true" data-targetselector="a" data-mode="ajax"
                                             data-height="500" data-width="750">
                                            {include file="frontend/_includes/messages.tpl" type="info" content="{s name="passportHint"}Bitte geben Sie Ihre Ausweisnummer ein (Siehe Abbildung). Die Daten werden
                                            ausschließlich zur Überprüfung verwendet und werden weder an Dritte weitergeleitet noch von uns gespeichert.{/s} <a class='btn' href='{url controller="custom" sCustom="46"}'>{s name="passportCheckProblems"}Probleme / Ausländische Dokumente?{/s}</a>"}
                                        </div>
                                        <button  class="submit btn is--primary">{s name="passportCheckSubmit"}Prüfen{/s}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab--container">
                            <div class="tab--header">
                                <a href="#" class="tab--title"
                                   title="{s name="perso-passport"}{/s}">{s name="perso-passport"}{/s}</a>
                            </div>
                            <div class="tab--preview">
                                {s name="perso3Preview"}Sie haben einen Reisepass?{/s}<a href="#"
                                                                                         class="tab--link"
                                                                                         title=" mehr"> {s name="moreLink"}Weiter{/s}</a>
                            </div>
                            <div class="tab--content">
                                <div class="buttons--off-canvas">
                                    <a href="#" title="Menü schließen" class="close--off-canvas">
                                        <i class="icon--arrow-left"></i>
                                        {s name="closeMenu"}Menü schließen{/s}
                                    </a>
                                </div>
                                <div class="content--description">
                                    <img class="passport-image"
                                         src="{link file="frontend/_public/src/img/perso_passport.png"}"/>
                                    <div class="passport-form"  data-documentcheck="true" data-url="{url controller="ZedacoMinorCheck" action="check"}">
                                        <div class="row">
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockA"}Block 1:{/s}</label>
                                                <input type="text" name="persoCheck[blockA]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockB"}Block 2:{/s}</label>
                                                <input type="text" name="persoCheck[blockB]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockC"}Block 3:{/s}</label>
                                                <input type="text" name="persoCheck[blockC]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockD"}Block 4:{/s}</label>
                                                <input type="text" name="persoCheck[blockD]"/>
                                            </div>
                                        </div>
                                        <input type="hidden" name="persoCheck[type]" value="perso-passport">
                                        <div class="hint" data-modalbox="true" data-targetselector="a" data-mode="ajax"
                                             data-height="500" data-width="750">
                                            {include file="frontend/_includes/messages.tpl" type="info" content="{s name="passportHint"}Bitte geben Sie Ihre Ausweisnummer ein (Siehe Abbildung). Die Daten werden
                                            ausschließlich zur Überprüfung verwendet und werden weder an Dritte weitergeleitet noch von uns gespeichert.{/s} <a class='btn' href='{url controller="custom" sCustom="46"}'>{s name="passportCheckProblems"}Probleme / Ausländische Dokumente?{/s}</a>"}
                                        </div>
                                        <button  class="submit btn is--primary">{s name="passportCheckSubmit"}Prüfen{/s}</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab--container">
                            <div class="tab--header">
                                <a href="#" class="tab--title"
                                   title="{s name="perso-titel"}{/s}">{s name="perso-titel"}{/s}</a>
                            </div>
                            <div class="tab--preview">
                                {s name="perso4Preview"}Sie haben einen Aufenthaltstitel?{/s}<a href="#"
                                                                                                class="tab--link"
                                                                                                title=" mehr"> {s name="moreLink"}Weiter{/s}</a>
                            </div>
                            <div class="tab--content">
                                <div class="buttons--off-canvas">
                                    <a href="#" title="Menü schließen" class="close--off-canvas">
                                        <i class="icon--arrow-left"></i>
                                        {s name="closeMenu"}Menü schließen{/s}
                                    </a>
                                </div>
                                <div class="content--description">
                                    <img class="passport-image"
                                         src="{link file="frontend/_public/src/img/perso_title.png"}"/>
                                    <div class="passport-form"  data-documentcheck="true" data-url="{url controller="ZedacoMinorCheck" action="check"}">
                                        <div class="row">
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockA"}Block 1:{/s}</label>
                                                <input type="text" name="persoCheck[blockA]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockB"}Block 2:{/s}</label>
                                                <input type="text" name="persoCheck[blockB]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockC"}Block 3:{/s}</label>
                                                <input type="text" name="persoCheck[blockC]"/>
                                            </div>
                                            <div class="passport-block">
                                                <label>{s name="PassportBlockD"}Block 4:{/s}</label>
                                                <input type="text" name="persoCheck[blockD]"/>
                                            </div>
                                        </div>
                                        <input type="hidden" name="persoCheck[type]" value="perso-titel">
                                        <div class="hint" data-modalbox="true" data-targetselector="a" data-mode="ajax"
                                             data-height="500" data-width="750">
                                            {include file="frontend/_includes/messages.tpl" type="info" content="{s name="passportHint"}Bitte geben Sie Ihre Ausweisnummer ein (Siehe Abbildung). Die Daten werden
                                            ausschließlich zur Überprüfung verwendet und werden weder an Dritte weitergeleitet noch von uns gespeichert.{/s} <a class='btn' href='{url controller="custom" sCustom="46"}'>{s name="passportCheckProblems"}Probleme / Ausländische Dokumente?{/s}</a>"}
                                        </div>
                                        <button  class="submit btn is--primary">{s name="passportCheckSubmit"}Prüfen{/s}</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    {/if}
{/block}