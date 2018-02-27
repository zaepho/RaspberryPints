<table>
    <thead>
        <tr>
            {if $config[ConfigNames::ShowTapNumCol]}<th class="tap-num">TAP<br>#</th>{/if}
            {if $config[ConfigNames::ShowSrmCol]}<th class="srm">GRAVITY<hr>COLOR</th>{/if}
            {if $config[ConfigNames::ShowIbuCol]}<th class="ibu">BALANCE<hr>BITTERNESS</th>{/if}
            <th class="name">BEER NAME &nbsp; & &nbsp; STYLE<hr>TASTING NOTES</th>
            {if $config[ConfigNames::ShowAbvCol]}<th class="abv">CALORIES<hr>ALCOHOL</th>{/if}
            {if $config[ConfigNames::ShowKegCol]}<th class="keg">POURED<hr>REMAINING</th>{/if}
        </tr>
    </thead>
    <tbody>
        {foreach $taps as $tap}
            {assign var="beer" value=$tap->get_beer() }
            {assign var="keg" value=$tap->get_keg() }
            {assign var="style" value=$beer->get_beerStyle() }
            <tr class="{cycle values="altrow,"}" id="{$tap->get_tapNumber()}">
                {if $config[ConfigNames::ShowTapNumCol]}
                    <td class="tap-num">
                        <span class="tapcircle">{$tap->get_tapNumber()}</span>
                    </td>
                {/if}
                
                {if $config[ConfigNames::ShowSrmCol]}
                    <td class="srm">
                        <h3>{$beer->get_og()} OG</h3>
                        <div class="srm-container">
                            <div class="srm-indicator" style="background-color: rgb({$SRM2RGB[$beer->get_srm()]})"></div>
                            <div class="srm-stroke"></div>
                        </div>
                        <h2>{$beer->get_srm()} SRM</h2>
                    </td>
                {/if}
                {if $config[ConfigNames::ShowIbuCol]}
                    <td class="ibu">
                        <h3>{$beer->get_bitternessRatio()|string_format:"%.2f"} BU:GU</h3>
                        <div class="ibu-container">
                            {if $beer->get_ibu() > 100}
                                {assign var="effectiveIBU" value=100} 
                            {else} 
                                {assign var="effectiveIBU" value=$beer->get_ibu()}
                            {/if}
                            <div class="ibu-indicator">
                                <div class="ibu-full" style="height:{$effectiveIBU}%"></div>
                            </div>
                        </div>
                        <h2>{$beer->get_ibu()} IBU</h2>
                    </td>
                {/if}
                <td class="name">
                    <h1>{$beer->get_name()}</h1>
                    <h2 class="subhead">Style:{$style->get_name()}</h2>
                    <p>{$beer->get_notes()}</p>
                </td>
                {if $config[ConfigNames::ShowAbvCol]}
                    <td class="abv">{$beer->get_totalCal()} kCal<hr>{$beer->get_abv()}</td>
                {/if}
                {if $config[ConfigNames::ShowKegCol]}
                    <td class="keg">
                        {if $tap->get_percentFull() <= 0}
                            {assign var=kegImgClass value="keg-empty"}
                        {elseif $tap->get_percentFull() < 15}
                            {assign var=kegImgClass value="keg-red"}
                        {elseif $tap->get_percentFull() < 25}
                            {assign var=kegImgClass value="keg-orange"}
                        {elseif $tap->get_percentFull() < 45}
                            {assign var=kegImgClass value="keg-yellow"}
                        {elseif $tap->get_percentFull() < 100}
                            {assign var=kegImgClass value="keg-green"}
                        {elseif $tap->get_percentFull() >= 100}
                            {assign var=kegImgClass value="keg-full"}
                        {else}
                            {assign var=kegImgClass value="keg-empty"}
                        {/if}

                        <h3>{$tap->get_ozPoured()} Oz Poured</h3>
                        <div class="keg-container">
                            <div class="keg-indicator">
                                <div class="keg-full {$kegImgClass}" style="height:{$tap->get_percentFull()}%"></div>
                            </div>
                        </div>
                        <h2>{$tap->get_currentAmountOz()} fl oz left</h2>
                    </td>
                {/if}
            </tr>    
        {/foreach}
    </tbody>
</table>