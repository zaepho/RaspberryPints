<table>
    <thead>
        <tr>
            {if $config[ConfigNames::ShowTapNumCol]}<th class="tap-num">TAP<br>#</th>{/if}
            {if $config[ConfigNames::ShowSrmCol]}<th class="srm">GRAVITY<hr>COLOR</th>{/if}
            {if $config[ConfigNames::ShowIbuCol]}<th class="ibu">BALANCE<hr>BITTERNESS</th>}
            <th class="name">BEER NAME &nbsp; & &nbsp; STYLE<hr>TASTING NOTES</th>
            {if $config[ConfigNames::ShowAbvCol]}<th class="abv">CALORIES<hr>ALCOHOL</th>{/if}
            {if $config[ConfigNames::ShowKegCol]}<th class="keg">POURED<hr>REMAINING</th>{/if}
        </tr>
    </thead>
    <tbody>
        {foreach from=beers item=beer key=key}
            <tr>
                {if $config[ConfigNames::ShowTapNumCol]}
                    <td class="tap-num">
                        <span class="tapcircle">{$beer.get_tapNumber()}</span>
                    </td>
                {/if}
                {if $config[ConfigNames::ShowSrmCol]}<td class="srm">
                    <td class="srm">
                        <h3>{$beer.get_og()} OG</h3>
                        <div class="srm-container">
                            <div class="srm-indicator" style="background-color: rgb({$SRM2RGB[$beer.get_srm()]}"></div>
                            <div class="srm-stroke"></div>
                        </div>

                        <h2>{$beer['srm']} SRM</h2>
                    </td>
                {/if}
                {if $config[ConfigNames::ShowIbuCol]}
                    <td class="ibu">
                        <h3>{$beer.bitternessRatio} BU:GU</h3>
                        <div class="ibu-container">
                            {if $beer.ibu > 100}{assign var="effectiveIBU" value=100} {else} {assign var="effectiveIBU" value=$beer.ibu}{/if}
                            <div class="ibu-indicator"><div class="ibu-full" style="height:{$effectiveIBU}%"></div>
                        </div>
                        <h2>{$beer.ibu} IBU</h2>
                    </td>
                {/if}
                <td class="name">
                    <h1>{$beer.beername}></h1>
                    <h2 class="subhead">{$beer.style}</h2>
                    <p>{$beer.notes}</p>    
                </td>
                {if $config[ConfigNames::ShowAbvCol]}<td class="abv">{$beer.get_totalCal()} kCal<hr>$beer.get_abv()</td>{/if}
                {if $config[ConfigNames::ShowKegCol]}<td class="keg">
                    {if $beer->get_percentFull() <= 0}{assign var=kegImgClass value="keg-empty"}
                        {elseif $beer->get_percentFull() < 15}{assign var=kegImgClass value="keg-red"}
                        {elseif $beer->get_percentFull() < 25}{assign var=kegImgClass value="keg-orange"}
                        {elseif $beer->get_percentFull() < 45}{assign var=kegImgClass value="keg-yellow"}
                        {elseif $beer->get_percentFull() < 100}{assign var=kegImgClass value="keg-green"}
                        {elseif $beer->get_percentFull() >= 100}{assign var=kegImgClass value="keg-full"}
                    {/if}

                    <h3>{$beer.get_ozPoured()} Oz</h3>{math equation="current * 128" current=$beer.get_currentAmount()} Oz
                    <div class="keg-container">
                        <div class="keg-indicator">
                            <div class="keg-full {$kegImgClass}" style="height:{$beer.get_percentFull()}%"></div>
                        </div>
                    </div>
					<h2>{$beer.get_currentAmount()} fl oz left</h2>
                </td>{/if}
            </tr>    
        {/foreach}
    </tbody>
</table>