import { IRegions, IRegion, IRegionSchool } from './regionschools.types';
import { INITIAL_STATE } from './regionschools.initial-state';
import { Seq } from 'immutable';

import {
  REGIONSCHOOLS_RECEIVED,
  REGIONSCHOOLS_SELECTED_SAVE
} from '../../constants';

export function regionSchoolsReducer(state: IRegions = INITIAL_STATE, action): IRegions {
  switch (action.type) {
    case REGIONSCHOOLS_RECEIVED:
        let newRegions = Array<IRegion>();
        let i=0;
        action.payload.regions.forEach(region => {
            newRegions.push(<IRegion>{region_id: region.region_id, region_name: region.region_name, ieks: Array<IRegionSchool>() });
            region.ieks.forEach(iek => {
                newRegions[i].ieks.push(<IRegionSchool>{iek_id: iek.iek_id, iek_name: iek.iek_name, globalIndex: iek.globalIndex, selected: iek.selected });
            })
            i++;
        });
        return Seq(newRegions).map(n => n).toList();
    case REGIONSCHOOLS_SELECTED_SAVE:
        let regionsWithSelections = Array<IRegion>();
        let ind=0, j = 0;
        state.forEach(region => {
            regionsWithSelections.push(<IRegion>{region_id: region.region_id, region_name: region.region_name, ieks: Array<IRegionSchool>()});
            region.ieks.forEach(iek => {
                regionsWithSelections[ind].ieks.push(<IRegionSchool>{iek_id: iek.iek_id, iek_name: iek.iek_name, globalIndex: iek.globalIndex, selected: action.payload.regionSchoolsSelected[j]});
                j++;
            })
            ind++;
        });
        return Seq(regionsWithSelections).map(n => n).toList();
    default: return state;
  }
};
