import { IRegions, IRegion, IRegionSchool } from './regionschools.types';

export function deimmutifyRegionSchools(state: IRegions): IRegion[] {
    let fetchedRegions =  new Array<IRegion>();
    let i = 0;
    state.forEach(region => {
        fetchedRegions.push(<IRegion>{region_id: region.region_id, region_name: region.region_name, ieks: Array<IRegionSchool>()});
        region.ieks.forEach(iek => {
            fetchedRegions[i].ieks.push(<IRegionSchool>{iek_id: iek.iek_id, iek_name: iek.iek_name, globalIndex: iek.globalIndex, selected: iek.selected})
        });
        i++;
    });
    return fetchedRegions;
};
